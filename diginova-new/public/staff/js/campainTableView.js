/*[PATH @digikala/supernova-digikala-marketplace/assets/local/js/tableView.js]*/
window.TableView = {
    init: function () {
        this.tableDefaultEmpty = false;
        this.searchFormDefaultArray = [];
        this.searchFormArray = [];
        this.searchFormSubmitted = false;
        this.staticFormData = [];
        this.initStaticFormData();
        this.initPrepareSearchRadioGroup();
        this.initSearchForm();
        this.initDataSetTable();
        this.initExpandTables();

        if (this.isNewUI()) {
            this.initSelect2();
        }

        this.initOnEndEvent();
    },

    serializeForm: function () {
        let $form = $('#searchForm');
        let $formArray = $form.serializeArray();
        let $formArrayFixed = {};
        for (let i = 0; i < $formArray.length; i++) {
            $formArrayFixed[$formArray[i]['name']] = $formArray[i]['value'];
        }
        return $formArrayFixed;
    },

    initSearchForm: function () {
        const $that = this;
        const $form = $('#searchForm');
        const $submitBtn = $('#submitButton');
        const $typeSelect = $('.js-select-type');
        const $statusSelect = $('.js-select-status');

        if (!$form.length) {
            return;
        }

        $that.searchFormArray = $that.serializeForm();
        $that.searchFormDefaultArray = $that.serializeForm();

        $('.js-persian-date-picker').persianDatepicker({
            initialValue: false,
            autoClose: true,
            format: 'YYYY/MM/DD'
        });

        // To manually configure date picker for the page
        if ($('.js-order-history-search-input').length) {
            $('.js-persian-date-picker').persianDatepicker({
                initialValue: false,
                autoClose: true,
                format: 'YYYY/MM/DD',
                observer: true,
                onSelect: function () {
                    $(this.model.inputElement).trigger('change');
                },
            });
        }

        $submitBtn.click(function () {
            if ($that.tableDefaultEmpty) {
                return false;
            }

            let $currentFormArray = $that.serializeForm();
            if (JSON.stringify($that.searchFormArray) === JSON.stringify($currentFormArray) && !window.canSearchWithNoChange) {
                return false;
            }

            $that.searchFormArray = $currentFormArray;
            $that.searchFormSubmitted = true;
            $that.search(1, $that.getItemsPerPage());

            // return false;
        });

        $form.on('submit', function (e) {
            e.preventDefault();
            $submitBtn.click();
        });


        if ($typeSelect.length) {
            $typeSelect.on('change', function (e) {
                e.preventDefault();
                $submitBtn.click()
            });
        }

        if ($statusSelect.length) {
            $statusSelect.on('change', function (e) {
                e.preventDefault()
                $submitBtn.click();
            })


        }

        $(document).on('click', '#export-button', function () {
            $that.requestExport($that.serializeForm(), $that.staticFormData);
            return false;
        });

        $('#export-invoice-button').click(function () {
            if ($that.tableDefaultEmpty) {
                return false;
            }

            let $currentFormArray = $that.serializeForm();
            if (JSON.stringify($that.searchFormArray) === JSON.stringify($currentFormArray)) {
                return false;
            }

            //TODO STUPID
            $that.searchFormArray = $currentFormArray;
            window.Services.ajaxPOSTRequestHTML(
                '/sellerinvoice/printinvoices/',
                $that.searchFormArray,
                function (response) {
                    if (response) {
                        window.open('/sellerinvoice/printinvoices/?order_created_at_from=' + $that.searchFormArray['search[order_created_at_from]']);
                    }
                }
            );

            return false;
        });

        $('#resetButton').click(function () {
            if ($that.tableDefaultEmpty) {
                return false;
            }

            const $productVariantAjax = $('.js-select2, .js-product-variant-ajax');
            if (!$that.searchFormSubmitted) {
                let $currentFormArray = $that.serializeForm();
                if (JSON.stringify($that.searchFormDefaultArray) === JSON.stringify($currentFormArray)) {
                    return false;
                }

                $form[0].reset();
                $productVariantAjax.val('').trigger('change');

                return false;
            }

            $form[0].reset();
            $productVariantAjax.val('').trigger('change');

            $that.searchFormArray = $that.serializeForm();
            $that.searchFormSubmitted = false;
            $that.search(1, $that.getItemsPerPage());

            return false;
        });
    },

    initDataSetTable: function () {
        const $searchTable = $('.js-search-table');

        if (!$searchTable.length) {
            return;
        }

        const $that = this;

        $(document).on('click', '.js-search-table-column-sortable', function () {
            $that.search($that.getCurrentPage(), $that.getItemsPerPage(), $(this).data('sort-column'), $(this).data('sort-order'));
        });

        $(document).on('click', '.js-search-pager a', function () {
            const $page = $(this).data('page');
            if ($page === $that.getCurrentPage()) {
                return;
            }

            const $searchUpdatedTable = $('.js-search-table');

            $that.search($page, $that.getItemsPerPage(), $searchUpdatedTable.data('sort-column'), $searchUpdatedTable.data('sort-order'));
        });

        $(document).on('change', '.js-search-items-per-page', function () {
            $that.search(1, $(this).val());
        });

        if (this.isNewUI) {
            if (this.isHeaderFloating()) {
                this.fixTableHeader();
            }

            if (this.hasCheckboxes()) {
                this.initRowSelection();
            }

            if (this.hasTooltips()) {
                this.initTooltips();
            }
        }

        if ($that.reloadInSeconds()) {
            setInterval(
                function () {
                    window.location.reload();
                },
                $that.reloadInSeconds() * 1000
            );
        }
    },

    initStaticFormData: function () {
        let $that = this;

        $('.js-static-form-data').each(function () {
            $that.staticFormData[$(this).attr('name')] = $(this).val();
        });
    },

    getCurrentPage: function () {
        let $aPage = $('ul.js-search-pager li.uk-active:first a');
        let $page;

        if ($aPage !== 'undefined' && ($page = $aPage.data('page'))) {
            return $page;
        }

        return 1
    },

    getSearchUrl: function (selector) {
        selector = selector || '.js-search-table';
        return $(selector).data('search-url');
    },

    getExportUrl: function () {
        return $('.js-search-table').data('export-url');
    },

    getItemsPerPage: function () {
        return $('.js-search-items-per-page:first').val();
    },

    isNewUI: function () {
        return $('.js-search-table').data('new-ui');
    },

    isHeaderFloating: function (tableSelector) {
        tableSelector = tableSelector || '.js-search-table';

        let $table = $(tableSelector);
        if (!isTable($table)) {
            $table = $table.find('table');
        }
        if ($table.length == 0 || !isTable($table)) {
            return;
        }
        return $table.data('is-header-floating');

        function isTable($el) {
            return $el[0].tagName === 'TABLE';
        }
    },

    hasCheckboxes: function (tableSelector) {
        tableSelector = tableSelector || '.js-search-table';

        let $table = $(tableSelector);
        if (!isTable($table)) {
            $table = $table.find('table');
        }
        if ($table.length == 0 || !isTable($table)) {
            return;
        }
        return $('.js-search-table').data('has-checkboxes');

        function isTable($el) {
            return $el[0].tagName === 'TABLE';
        }
    },

    hasTooltips: function () {
        return $('.c-ui-table__tooltip').length > 0;
    },

    reloadInSeconds: function () {
        return $('.js-search-table').data('auto-reload-seconds');
    },

    initExpandTables: function () {
        const $this = this;
        const tables = document.querySelectorAll('.c-ui-table');
        if (!tables) {
            return;
        }

        for (let i = 0, len = tables.length; i < len; i++) {
            $this.initTable(tables[i]);
        }
    },

    initTable: function (table) {
        let tableHeight = {value: null};

        if (table.classList.contains('js-table-expandable')) {
            this.expandTable(table, tableHeight);
        }
    },

    expandTable: function (table, tableHeight) {
        const tableClasses = {
            expander: 'c-ui-table__expander',
            togglerActive: 'c-ui-table__expander-control--expanded',
            hiddenRow: 'c-ui-table__expand-row--hidden',
        };
        let controls;
        let expandebles;
        let allToggle;
        const rowControls = table.querySelectorAll('tbody .' + tableClasses.expander);

        if (rowControls) {
            controls = [];
            expandebles = [];

            for (let i = 0, len = rowControls.length; i < len; i++) {
                rowControl(rowControls[i], controls, expandebles);
            }

            const allControl = table
                .querySelector('thead .' + tableClasses.expander);
            if (!allControl || !controls.length) {
                return;
            }

            allToggle = allControl.querySelector('.' + tableClasses.expander + '-control');
            if (!allToggle) {
                return;
            }

            allToggle.isExpanded = isExpanded(controls);
            controlClass(allToggle.classList, tableClasses.togglerActive, allToggle.isExpanded);
            toggleRowClass(allToggle.classList, allToggle.isExpanded);

            allToggle.addEventListener('click', function () {
                const expanded = !this.isExpanded;

                this.isExpanded = expanded;
                controlClass(this.classList, tableClasses.togglerActive, expanded);

                for (let i = 0, len = controls.length; i < len; i++) {
                    triggerControls(controls[i]);
                }

                toggleTargetRowsClass(expandebles, expanded);

                function triggerControls(control) {
                    control.isExpanded = expanded;
                    controlClass(control.classList, tableClasses.togglerActive, expanded);
                }
            });
        }

        function rowControl(control) {
            const toggler = control.querySelector('.' + tableClasses.expander + '-control');
            let expandableRows;

            if (toggler) {
                toggler.isExpanded = false;
                controlClass(toggler.classList, tableClasses.togglerActive, toggler.isExpanded);
                controls.push(toggler);

                const targetId = control.dataset.expand;
                if (!targetId) {
                    return;
                }

                expandableRows = table.querySelectorAll('[data-expand-target="' + targetId + '"]');
                if (!expandableRows) {
                    return;
                }

                for (let i = 0, len = expandableRows.length; i < len; i++) {
                    expandebles.push(expandableRows[i]);
                }

                toggler.addEventListener('click', toggleExpandableRows);
            }

            function toggleExpandableRows() {
                const controlExpanded = !this.isExpanded;
                this.isExpanded = controlExpanded;

                controlClass(this.classList, tableClasses.togglerActive, controlExpanded);
                toggleTargetRowsClass(expandableRows, controlExpanded);

                if (allToggle) {
                    const allExpanded = isExpanded(controls);
                    controlClass(
                        allToggle.classList,
                        tableClasses.togglerActive,
                        allExpanded
                    );
                    allToggle.isExpanded = allExpanded;
                }
            }

        }


        function controlClass(nodeClassList, className, expand) {
            nodeClassList[expand ? 'add' : 'remove'](className);
        }

        function isExpanded(arrOfNodes) {
            return arrOfNodes.some(checkExpand);
        }

        function checkExpand(node) {
            return node.isExpanded;
        }

        function toggleTargetRowsClass(nodes, show) {
            for (let i = 0, len = nodes.length; i < len; i++) {
                toggleRowClass(nodes[i].classList, show);
            }
            tableHeight.value = table.offsetHeight;
        }

        function toggleRowClass(nodeClassList, show) {
            nodeClassList[show ? 'remove' : 'add'](tableClasses.hiddenRow);
        }
    },

    search: function ($page, $itemsPerPage, $sortColumn, $sortOrder, $urlSelector, $containerSelector) {
        const $that = this;

        $containerSelector = $containerSelector || '.js-table-container';
        $($containerSelector + ' .c-loading').removeClass('c-loading--hidden');
        $($containerSelector + ' .c-card__loading').addClass('is-active');

        Services.showLoader = function () {
        };
        Services.hideLoader = function () {
        };
        let params = {};
        (new URL(location.href))
            .searchParams
            .forEach(function (v, k) {
                params[k] = v
            });
        let $loader = $('#pageLoader');
        if ($loader.length) {
            $('#pageLoader').addClass('c-content-loading');
            $('html').addClass('c-loader-overflow');
        }

        window.Services.ajaxPOSTRequestHTML(
            $that.getSearchUrl($urlSelector),
            $.extend(
                {
                    sortColumn: $sortColumn,
                    sortOrder: $sortOrder,
                    items: $itemsPerPage,
                    page: $page,
                    params: params
                },
                $that.searchFormArray,
                $that.staticFormData
            ),
            function (data) {
                $containerSelector = $containerSelector || '.js-table-container';
                $($containerSelector).replaceWith(data);
                window.ga('send', 'pageview');
                if ($that.isNewUI()) {
                    $that.initSelect2($containerSelector);

                    if ($that.isHeaderFloating($containerSelector)) {
                        $that.fixTableHeader($containerSelector);
                    }

                    if ($that.hasCheckboxes()) {
                        $that.initRowSelection();
                    }
                }

                const tables = document.querySelectorAll('.c-ui-table');
                if (!tables) {
                    return;
                }

                for (let i = 0, len = tables.length; i < len; i++) {
                    $that.initTable(tables[i]);
                }

                $($containerSelector).trigger('onSearchFinished');

                if ($loader.length) {
                    $('#pageLoader').removeClass('c-content-loading');
                    $('html').removeClass('c-loader-overflow');
                    Services.commonSelect2();
                }

                var $expandBtn = $('.js-expand-comment'),
                    $expandRow = $('.js-expanded-row');
                if ($expandBtn.length && $expandRow.length) {
                    $expandBtn.on('click', function () {
                        // toggle class of expand button parent row
                        $(this).parents('tr').toggleClass('c-profile-rating__expanded-product-row');

                        var expandeData = $(this).parent('td').data('expand'),
                            expandedRow = $(this).parents('tr').next();

                        $(this).toggleClass('c-ui-table__expander-control--expanded');
                        expandedRow.toggleClass('c-ui-table__expand-row--hidden');
                    });
                }
            },
            false,
            true
        );
    },

    requestExport: function ($searchFormArray, $staticFormData, $sortColumn, $sortOrder, $url) {
        $url = $url || this.getExportUrl();
        window.Services.ajaxPOSTRequestJSON(
            $url,
            $.extend(
                {
                    sortColumn: $sortColumn,
                    sortOrder: $sortOrder
                },
                $searchFormArray,
                $staticFormData
            ),
            function (data) {
                window.UIkit.modal.alert("<div class='modal-confirm'><span class='modal-confirm-icon' uk-icon='icon: warning; ratio: 5'></span> <h2></h2></div> " + data, {
                    labels: {
                        'ok': 'تایید'
                    }
                });
                $('.modal-confirm').parent().siblings('.uk-modal-footer').removeClass('uk-text-right').addClass('uk-text-center').css('border', 'none');
            },
            false,
            true
        );
    },

    initSelect2: function (containerSelector) {
        const $selects = containerSelector
            ? $(containerSelector).find('.js-search-items-per-page, .c-ui-select--common')
            : $('.js-search-items-per-page, .c-ui-select--common');

        if ($selects.length) {
            for (let i = 0, len = $selects.length; i < len; i++) {
                const $select = $($selects[i]);
                // const $dropdown = $select.siblings('.js-select-options').length > 0 && $select.siblings('.js-select-options') || null;
                $select.select2({
                    placeholder: $select.attr('placeholder'),
                    dropdownParent: null,
                    minimumResultsForSearch: $select.hasClass('c-ui-select--search') ? 0 : Infinity,
                    language: window.Services.selectSearchLanguage
                }).data('select2').$dropdown.addClass('c-ui-select__dropdown c-ui-select__dropdown--gap');

            }
        }
    },

    fixTableHeader: function (containerSelector) {
        containerSelector = containerSelector || '.js-table-container';

        const container = document.querySelector(containerSelector);
        const tables = container.querySelectorAll('.js-search-table');
        let navbarHeight;
        let posY;

        tables.forEach(function initTable(table) {
            let transformed;
            let ticker;

            const headerRow = table.querySelector('thead .c-ui-table__row');
            if (!headerRow) {
                return;
            }

            const headers = headerRow.querySelectorAll('.c-ui-table__header');
            if (headers) {
                if (!navbarHeight) {
                    const nav = document.querySelector('.js-header-nav');
                    navbarHeight = nav ? nav.clientHeight : 0;
                }
                posY = posY || window.scrollY;
                transformed = false;
                ticker = false;

                window.addEventListener('scroll', fixTableHeader);
            }

            function fixTableHeader() {
                posY = window.scrollY;
                if (!ticker) {
                    window.requestAnimationFrame(animateHeader);
                    ticker = true;
                }
            }

            function animateHeader() {
                setHeaderPosition();
                ticker = false;
            }

            function setHeaderPosition() {
                const MIN_POSITION = 300;
                const scrolled = posY;
                const tablePositionY = offsetTop(table, scrolled);
                const fromTop = navbarHeight + scrolled;
                const minShift = tablePositionY + table.scrollHeight - MIN_POSITION;

                if (fromTop > minShift) {
                    return;
                }
                if (fromTop >= tablePositionY) {
                    const translateY = Math.floor(fromTop - tablePositionY);
                    const transformValue = 'transform: translate3d(0, ' + translateY + 'px, 0);';

                    assignTransformToElements(headers, transformValue);
                    transformed = true;
                } else if (transformed) {
                    const transformValue = 'transform: none;';

                    assignTransformToElements(headers, transformValue);
                    transformed = false;
                }
            }
        });

        function assignTransformToElements(nodes, style) {
            for (let i = 0, length = nodes.length; i < length; i++) {
                nodes[i].style = style;
            }
        }

        function offsetTop(node, shiftY) {
            return node.getBoundingClientRect().top + shiftY;
        }
    },

    initTooltips: function () {
        $(document).on('mouseenter', '.c-ui-table__info', function () {
            const $info = $(this);
            const $tooltip = $info.find('.c-ui-table__tooltip');
            const $wrapper = $tooltip.closest('.c-ui-table');
            let $visibleTooltip = null;

            $tooltip.show();
            const style = {
                top: $tooltip.offset().top,
                left: $tooltip.offset().left,
                height: $tooltip.innerHeight(),
                display: 'block',
            };
            $visibleTooltip = $tooltip.clone().css(style).appendTo('body');
            $tooltip.removeAttr("style");

            $wrapper.on('scroll', detectScroll);
            $(document).on('scroll', detectScroll);
            $info.on('mouseleave', detectScroll);

            function detectScroll() {
                if (!$visibleTooltip) {
                    return;
                }

                /** @var $visibleTooltip.remove() */
                $visibleTooltip.remove();
                $wrapper.off('scroll', detectScroll);
                $(document).off('scroll', detectScroll);
            }
        });
    },

    initRowSelection: function (containerSelector) {
        containerSelector = containerSelector || '.c-ui-table';
        const checkboxesSelector = containerSelector + ' .c-ui-checkbox__origin';
        const $rowCheckboxes = $(checkboxesSelector);

        if (!($rowCheckboxes.length > 1)) {
            return;
        }

        $(document).on('change', checkboxesSelector, function () {
            const $toggledCheckbox = $(this);
            const $table = $toggledCheckbox.closest('.c-ui-table');
            const $checkboxes = $table.find('input:checkbox');
            let enabledCreateBtn = false;
            let isAllChecked = true;

            if ($checkboxes[0] === this) {
                enabledCreateBtn = this.checked;

                for (let i = 1, len = $checkboxes.length; i < len; i++) {
                    $checkboxes[i].checked = enabledCreateBtn;
                    setSelectedRow($checkboxes[i], enabledCreateBtn);
                }
            } else {
                for (let i = 1, len = $checkboxes.length; i < len; i++) {
                    if (!$checkboxes[i].checked) {
                        isAllChecked = false;
                        break;
                    }
                }
                $checkboxes[0].checked = isAllChecked;
                setSelectedRow(this, this.checked);
            }
        });

        let $variants = $('[name="selected-variants"]');

        if ($variants.length <= 0) {
            $variants = $('[name="search[selected-variants]"]');
        }

        if ($variants.length > 0) {
            let selectedVariants = $variants.val();

            if (selectedVariants.length > 0) {
                let activateCreateButton = false;

                selectedVariants = selectedVariants.split(',');

                const $orders = $('[name="add-to-order"]');
                if ($orders.length > 0) {
                    selectedVariants.forEach(function (value) {
                        $orders.each(function (key, item) {
                            if (item.value === value) {
                                $(this).prop('checked', true);
                                activateCreateButton = true;
                            }
                        });
                    });
                }

                const $consignment = $('[name="add-to-package"]');
                if ($consignment.length > 0) {
                    selectedVariants.forEach(function (value) {
                        $consignment.each(function (key, item) {
                            if (item.value === value) {
                                $(this).prop('checked', true);
                                activateCreateButton = true;
                            }
                        });
                    });
                }

                if (activateCreateButton) {
                    $('.js-create-package').attr('disabled', false);
                }
            }
        }

        function setSelectedRow(checkbox, isSelected) {
            const row = checkbox.closest('tr');
            if (!row) {
                return;
            }

            row.classList[isSelected ? 'add' : 'remove']('is-selected');
        }
    },

    initPrepareSearchRadioGroup() {
        $('.js-search-radio-group-container label').on('click', function () {
            if (!$(this).hasClass('c-ui-search-radio-group-container__label--checked')) {
                $(this).addClass('c-ui-search-radio-group-container__label--checked');
                $(this).siblings('label').removeClass('c-ui-search-radio-group-container__label--checked');

            }
        })
    },


    initOnEndEvent() {
        $(document).triggerHandler('tableViewEnd');
    }
};

$(function () {
    window.TableView.init();
});



/*[PATH @digikala/supernova-digikala-marketplace/assets/local/js/subTableView.js]*/
var SubTableView = {
    init: function () {
        this.initDataSetTable();
    },

    initDataSetTable : function () {
        let $that = this;

        $(document).on('click', '.js-sub-table-container ul.js-sub-search-pager a', function () {
            let $page = $(this).data('page');
            let $tableContainer = $(this).parents('.js-sub-table-container');
            let $searchTable = $tableContainer.find('table.js-sub-search-table');

            if ($page === $that.getCurrentPage($tableContainer)) {
                return;
            }

            $that.search($tableContainer, $searchTable, $page, $that.getItemsPerPage($tableContainer));
        });

        $(document).on('change', '.js-sub-table-container select.js-sub-search-items-per-page', function () {
            let $tableContainer = $(this).parents('.js-sub-table-container');
            let $searchTable = $tableContainer.find('table.js-sub-search-table');

            $that.search($tableContainer, $searchTable, 1, $(this).val());
        });
    },

    getCurrentPage : function ($tableContainer) {
        let $aPage = $tableContainer.find('ul.js-sub-search-pager li.uk-active:first a');
        let $page;

        if ($aPage !== 'undefined' && ($page = $aPage.data('page'))) {
            return $page;
        }

        return 1
    },

    getSearchUrl : function ($searchTable) {
        return $searchTable.data('search-url');
    },

    getItemsPerPage : function ($tableContainer) {
        return $tableContainer.find('.js-sub-search-items-per-page').val();
    },

    isNewUI: function ($searchTable) {
        return $searchTable.data('new-ui');
    },

    search : function ($tableContainer, $searchTable, $page, $itemsPerPage) {
        const $that = this;
        $searchTable.find('.c-loading').removeClass('c-loading--hidden');
        $searchTable.find('.c-card__loading').addClass('is-active');
        let $staticFormData = [];

        $('.js-static-sub-form-data').each(function () {
            $staticFormData[$(this).attr('name')] = $(this).val();
        });

        window.Services.ajaxPOSTRequestHTML(
            $that.getSearchUrl($searchTable),
            $.extend(
                {
                    items: $itemsPerPage,
                    page: $page
                },
                $staticFormData
            ),
            function (data) {
                $tableContainer.html(data);

                if ($that.isNewUI($searchTable)) {
                    $that.initSelect2($tableContainer);
                }
            },
            false,
            false
        );
    },

    initSelect2 : function ($tableContainer) {
        const $selects = $tableContainer.find('.js-sub-search-items-per-page');
        if ($selects.length) {
            for (let i = 0, len = $selects.length; i < len; i++) {
                const $select = $($selects[i]);
                $select.select2({
                    placeholder: $select.attr('placeholder'),
                    minimumResultsForSearch: $select.hasClass('c-ui-select--search') ? 0 : Infinity,
                    language: window.Services.selectSearchLanguage
                }).data('select2').$dropdown.addClass('c-ui-select__dropdown c-ui-select__dropdown--gap');
            }
        }
    }
};

$(function () {
    SubTableView.init();
});



/*[PATH @digikala/supernova-digikala-marketplace/assets/local/js/promotion.js]*/
var Promotion = {
    init: function () {
        this.initSelect();
        this.initDatePickers();
        this.initTableInput();
        this.initNumericInput();
        this.initSearchForm();
    },

    initSelect: function () {
        var selects = document.querySelectorAll('.c-ui-select--common');
        if (!selects) {
            return;
        }

        for (var i = 0, len = selects.length; i < len; i++) {
            setSelect2(selects[i]);
        }

        function setSelect2(select)
        {
            var $select = $(select);
            var selectPlaceholder = $select.attr('placeholder');
            var hasSearch = $select.hasClass('c-ui-select--search');

            $select.select2({
                placeholder: selectPlaceholder,
                minimumResultsForSearch: hasSearch ? 0 : Infinity,
                language: window.Services.selectSearchLanguage
            }).data('select2').$dropdown.addClass('c-ui-select__dropdown c-ui-select__dropdown--gap');
        }
    },

    initDatePickers: function () {

        var initDatePicker = function (el, onSelectExtraWorks) {

            var name = $(el).attr('data-name');
            var id = name.replace(/(:|\.|\[|\]|\\)/g, '_');
            $(el).siblings('input[type="hidden"]').first().attr('id', id);
            $(el).attr('data-name', id);
            var date = $(el).data('date') | 0;
            var time = $(el).data('time') | 0;
            var format = $(el).data('format') || 'LLLL';
            var value = $(el).val();
            return $(el).persianDatepicker({
                format: format,
                initialValue: value,
                altFormat: 'g',
                altField: '#' + $(el).attr('data-name'),
                firstRun: true,
                firstRunPersian: true,
                autoClose: !time && true,
                onlyTimePicker: !date,
                minDate: $(el).data('from-today') ? new Date().getTime() : null,
                timePicker: {
                    enabled: time,
                    second: false
                },
                toolbox: {
                    submitButton: {
                        enabled: true
                    },
                    todayButton: {
                        enabled: false
                    },
                    calendarSwitch: {
                        enabled: false
                    }
                },
                altFieldFormatter: function (unixDate) {
                    var self = this;
                    var thisAltFormat = self.altFormat.toLowerCase();

                    if (thisAltFormat === 'gregorian' || thisAltFormat === 'g') {
                        var d = new Date(unixDate);
                        var dateTime = [];
                        if (!this.onlyTimePicker) {
                            dateTime.push(d.getFullYear() + '-' + ("0" + (d.getMonth() + 1)).slice(-2) + '-' + ("0" + d.getDate()).slice(-2));
                        }
                        if (this.timePicker.enabled) {
                            dateTime.push(("0" + d.getHours()).slice(-2) + ':' + ("0" + d.getMinutes()).slice(-2) + ':' + ("0" + d.getSeconds()).slice(-2));
                        }
                        return dateTime.join(' ');
                    }
                    if (thisAltFormat === 'iso') {
                        var d = new Date(unixDate);
                        return d.toISOString();
                    }

                },
                formatter: function (unixDate) {
                    var self = this;
                    var pdate = new persianDate(unixDate);
                    pdate.formatPersian = this.persianDigit;
                    return pdate.format(self.format);
                },
                onSelect: function (unixDate) {
                    $(el).siblings('input[type="hidden"]').first().trigger('change');
                    $(el).keyup();
                    if (!!onSelectExtraWorks) {
                        onSelectExtraWorks(unixDate);
                    }
                }
            });
        };

        $('.js-promotion-date-picker').each(function () {
            $(this).attr('value', $(this).attr('value').replace(/-/ig, '/'));

            //if data picker is already initialized get the value from hidden input field
            var hiddenFieldName = $(this).data('name');
            var hiddenField = $('[name="' + hiddenFieldName + '"]');
            if (hiddenField.length) {
                $(this).attr('value', hiddenField.val());
            }
            initDatePicker(this);
        });

        // TODO : fix range date picker
        $('.js-promotion-range-date-picker').each(function () {
            var $rangeContainer = $(this);
            var $fromElem = $rangeContainer.find('.js-date-from').first();
            var $toElem = $rangeContainer.find('.js-date-to').first();
            var from, to;

            from = initDatePicker($fromElem.get(0), function (unix) {
                from.touched = true;
                if (to && to.options && to.options.minDate !== unix) {
                    var cachedValue = to.getState().selected.unixDate;
                    to.options = {minDate: unix};
                    if (to.touched) {
                        to.setDate(cachedValue);
                    }
                }
            });

            to = initDatePicker($toElem.get(0), function (unix) {
                to.touched = true;
                if (from && from.options && from.options.maxDate !== unix) {
                    var cachedValue = from.getState().selected.unixDate;
                    from.options = {maxDate: unix};
                    if (from.touched) {
                        from.setDate(cachedValue);
                    }
                }
            });
        });
    },
    initTableInput: function () {
        $(document).on('click', '.js-spinner-wheel', function (e) {
            var wheelStep = $(this).hasClass('js-spinner-wheel-up') ? 1 : -1;
            var siblingInput = $(this).parents('.js-number-input-wrapper').children('input');
            var currentVal = parseInt(siblingInput.val());
            var min = siblingInput.attr('min') || 1;
            var max = siblingInput.attr('max') || 1000;
            if (isNaN(currentVal)) {
                currentVal = 0;
                siblingInput.val(min);
            }
            if (currentVal >= min) {
                var nextVal = currentVal + wheelStep;
                if (nextVal <= min) {
                    siblingInput.val(min);
                } else if (nextVal >= max) {
                    siblingInput.val(max);
                } else {
                    siblingInput.val(nextVal);
                }
            } else {
                siblingInput.val(min);
            }

            $($(this).closest('.js-number-input-wrapper').find('.js-number-input'), document).change();
        });

        $(document).on('keydown', '.js-number-input', function (e) {
            if (e.keyCode === 38) {
                $($(this).parent('.js-number-input-wrapper').find('.js-spinner-wheel-up'), document).click();
            } else if (e.keyCode === 40) {
                $($(this).parent('.js-number-input-wrapper').find('.js-spinner-wheel-down'), document).click();
            }
        });


        var timeout;

        $(document).on('mousedown', '.js-spinner-wheel', function () {
            var $button = $(this);
            timeout = setInterval(function () {
                if ($button.hasClass('js-spinner-wheel-up')) {
                    $($button.closest('.js-number-input-wrapper').find('.js-spinner-wheel-up'), document).click();
                } else {
                    $($button.closest('.js-number-input-wrapper').find('.js-spinner-wheel-down'), document).click();
                }

                $($button.closest('.js-number-input-wrapper').find('.js-number-input'), document).change();
            }, 150);

            return false;
        });

        $(document).on('mouseup', '.js-spinner-wheel', function () {
            clearInterval(timeout);
            return false;
        });
    },
    initNumericInput: function () {
        $('.js-numeric-input', document).inputFilter(function (value) {
            return /^\d*$/.test(value); // Allow digits only, using a RegExp
        });
    },
    initSearchForm: function () {
        $(document).on('change', '.js-auto-submit', function () {
           $(this).closest('form').submit();
        });
    },
    displayError: function (errors) {
        var message = '';
        if (typeof errors === typeof  "") {
            message = errors;
        } else if (typeof errors === typeof {}) {
            try {
                message = Object.values(errors).join('<br/>');
            } catch (e) {
                message = errors;
            }
        }
        UIkit.notification({
            message: message,
            status: 'danger',
            pos: 'bottom-right',
            timeout: 8000
        });
    }
};

(function ($) {
    $.fn.inputFilter = function (inputFilter) {
        return this.on('input keydown keyup mousedown mouseup select contextmenu drop', function () {
            if (inputFilter(this.value)) {
                this.oldValue = this.value;
                this.oldSelectionStart = this.selectionStart;
                this.oldSelectionEnd = this.selectionEnd;
            } else if (this.hasOwnProperty("oldValue")) {
                this.value = this.oldValue;
                this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
            } else {
                this.value = "";
            }
        });
    };
}(jQuery));

$(function () {
    Promotion.init();
});



/*[PATH @digikala/supernova-digikala-marketplace/assets/local/js/controllers/productListController/indexAction.js]*/
var IndexAction = {
    init: function () {
        this.initCopyBtn();
        this.initRemoveActions();
    },

    initCopyBtn: function () {
        $('.js-copy-btn').on('click', function(e) {
            e.preventDefault();
            var txt = $(this).data('link');
            copyToClipboard(txt);
        });

        function copyToClipboard(text) {
            var aux = document.createElement("input");
            aux.setAttribute("value", text);
            document.body.appendChild(aux);
            aux.select();
            document.execCommand("copy");
            document.body.removeChild(aux);
        }
    },

    initRemoveActions: function () {
        $('.js-remove-product-list').on('click', function (e) {
            e.preventDefault();

            var removeUrl = $(this).data('url');
            if (!removeUrl || removeUrl.length === 0) return;
            var $this = $(this);

            var confirmRemove = confirm('آیا واقعا می‌خواهید صفحه را حذف کنید؟');
            if (confirmRemove === true) {
                Services.ajaxPOSTRequestJSON(
                    removeUrl,
                    {},
                    function () {
                        UIkit.notification({
                            message: 'کمپین حذف شد',
                            status: 'success',
                            pos: 'top-left',
                            timeout: 3000
                        });
                        $this.closest('tr').remove();
                    },
                    function (errors) {
                        Promotion.displayError(errors.errors);
                    }
                )
            }
        });
    }
};

$(function () {
    IndexAction.init();
});
