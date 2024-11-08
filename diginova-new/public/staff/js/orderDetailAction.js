/*[PATH @digikala/supernova-digikala-marketplace/assets/local/js/controllers/reportsController/orderHistoryAction.js]*/
let OrderHistoryAction = {
    rootElement: undefined,

    init: function () {
        this.rootElement = $('#orderRoot');

        const functions = [
            this.initPrepareDatePicker,
            this.initPrepareNewToolTip,
            this.initModalsHandler,
            this.initSelect2Handler,
            this.initOnMinimize,
            this.initSearchForm,
            this.initExcelExportPreparations,
        ];
        const initFunction = this;
        $(functions).map(function (index, item) {
            item = item.bind(initFunction);
            try {
                item();
            } catch (e) {
                // eslint-disable-next-line no-console
                console.warn(e);
            }
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
  },

    initSelect2Handler: function () {
        let selects = $('.js-order-report-select2');
        $.each(selects, (index, select) => {
            $(select).select2({
                placeholder: $(select).attr('placeholder'),
                tags: true,
                clear: true,
                closeOnSelect: true,
                minimumResultsForSearch: -1,
                language: {
                    noResults: function () {
                        return "موردی یافت نشد";
                    }
                },
                escapeMarkup: function (markup) {
                    return markup;
                }
            }).data('select2').$dropdown.addClass('c-ui-select__dropdown c-ui-select__dropdown--gap');
            $(select).data('select2').$selection.addClass('c-order-history__select-container');
        });

        // Fix empty selected option problem in status
        let statusSelectedOption = $('#orderHistoryStatusFilter').find('select option[data-select2-id="3"]').eq(0);
        if (!statusSelectedOption.val()) {
            statusSelectedOption.remove();
        }
    },

    initPrepareNewToolTip: function () {
        let tooltipId = 'orderHistoryTooltip';
        let count = 0;
        this.rootElement
            .on('mouseenter', '.js-p-rd-tooltip', function () {
                const tooltipTextEl = $(this).find('span[class*="c-order-history__tooltip"]').clone();
                tooltipTextEl.css('position', 'absolute')
                $('#orderRoot').append(tooltipTextEl);

                if (tooltipTextEl) {
                    count++;
                    tooltipId += count + '';
                    tooltipTextEl.prop('id', tooltipId);
                    tooltipTextEl.css('visibility', 'visible');

                    if (tooltipTextEl.hasClass('c-order-history__tooltip--bottom-middle')) {
                        tooltipTextEl.offset(
                            {
                                top: $(this).offset().top + $(this).height() + 10,
                                left: $(this).offset().left + $(this).width() / 2 - tooltipTextEl.width()/2 - 5
                            }
                        );
                    } else if (tooltipTextEl.hasClass('c-order-history__tooltip--bottom-left')) {
                        tooltipTextEl.offset(
                            {
                                top: $(this).offset().top + $(this).height() + 5,
                                left: $(this).offset().left + 10 - tooltipTextEl.width() - 5
                            }
                        )
                    } else if (tooltipTextEl.hasClass('c-order-history__tooltip--bottom-right')) {
                        tooltipTextEl.offset(
                            {
                                top: $(this).offset().top + $(this).height() + 10,
                                left: $(this).offset().left + $(this).width()/2 - 15
                            }
                        )
                    }
                }
            });
        this.rootElement
            .on('mouseleave', '.js-p-rd-tooltip', function () {
                const tooltipTextEl = $('#'+ tooltipId);
                if (tooltipTextEl) {
                    tooltipTextEl.css('visibility', 'hidden');
                    tooltipTextEl.remove();
                }
            });
    },

    initModalsHandler: function () {
        let serialId;
        const modalConfirmButton = $('.js-cashback-modal-confirm');
        const modalSelect = $('#orderHistoryRefundClaimModalSelect');
        this.rootElement.on('click','#orderNormalCashback', function () {
            UIkit.modal('#orderReportCashbackModal').show();
            modalSelect.trigger('change');
            serialId = $(this).parent().data('serial-id');
        });

        modalSelect
            .on('change', function () {
                if (!$(this).find('option:selected').val()) {
                    modalConfirmButton.prop('disabled', true);
                } else {
                    modalConfirmButton.prop('disabled', false);
                }
            });

        modalConfirmButton
            .on('click', function () {
                UIkit.modal('#orderReportCashbackModal').hide();
                const reasonId = modalSelect.find('option:selected').val();

                Services.ajaxPOSTRequestJSON(
                    '/ajax/order/claim',
                    {serial_id: serialId, reason_id: reasonId},
                    function () {
                        UIkit.modal('#orderReportSuccessModal').show();
                    },
                    function (error) {
                        window.UIkit.notification(error, {
                            status: "danger",
                            pos: "bottom-right",
                            timeout: 5000
                        });
                    }
                );
            })

        $('.js-cashback-modal-close').on('click', function () {
            UIkit.modal('#orderReportCashbackModal').hide();
        });

        $('#orderReportSuccessModalButton').on('click', function () {
            location.reload();
            UIkit.modal('#orderReportSuccessModal').hide();
        });

        $('#orderReportSuccessModalClose').on('click', function () {
            location.reload();
        });
    },

    initOnMinimize: function () {
        this.rootElement.on('click', '.js-order-history-minimize-item', function () {
            $(this).parent().parent().next().toggleClass('c-order-history__item-body--minimized');
            $(this).parent().parent().toggleClass('c-order-history__item-header--minimized');
            $(this).toggleClass('c-order-history__minimize-button');
            $(this).toggleClass('c-order-history__maximize-button');
        });
    },

    initSearchForm: function () {
        OrderHistorySearchAction.init();
    },

    initPrepareDatePicker: function () {
        $('.js-persian-date-picker').persianDatepicker({
            initialValue: false,
            autoClose: true,
            format: 'YYYY/MM/DD',
            observer: true,
            onSelect: function () {
                $(this.model.inputElement).trigger('change');
            },
        });
    },

    initExcelExportPreparations: function () {
        // $('#orderHistoryExcelExportButton').top()
        // const excelExportButton = $('#orderHistoryExcelExportButton').detach();
        // excelExportButton.toggleClass('uk-hidden');
        // $('#orderRoot').find('.c-card__paginator').eq(0).parent().prepend(excelExportButton);
    }
}

let OrderHistorySearchAction = {
    searchForm: undefined,
    filtersBar: undefined,

    init: function () {
        this.filtersBar = $('#orderHistorySearchFilterBar');
        this.searchForm = $(document).find('#searchForm');
        this.checkIfAnyFilterSelected();

        const functions = [
            this.initHandleMainSearchItemChange,
            this.initHandleSearchSubItemChange,
            this.initHandleSearchTextSearch,
            this.initOnRemove,
            this.initOnRemoveAll,
            this.initSearchTextButtonActivation,
        ];

        const initFunction = this;
        $(functions).map(function (index, item) {
            item = item.bind(initFunction);
            try {
                item();
            } catch (e) {
                // eslint-disable-next-line no-console
                console.warn(e);
            }
        });
    },


    submitSearchForm: function () {
        this.searchForm.submit();
    },


    initHandleMainSearchItemChange: function () {
        $('.js-order-history-search-input').on('input change select2-selecting', function () {
            const filterBox = $('#' + $(this).parents('div:first').prop('id') + 'Selected');
            let filterLabel;

            if ($(this).val() && $(this).val() !== '' && $(this).val() !== '0') {
                OrderHistorySearchAction.filtersBar.removeClass('c-order-history__search-filters-bar--invisible');
                filterBox.removeClass('c-order-history__search-filter--invisible');
                $('#orderHistoryExcelExportButton').parent().css('top', '410px');

                // To find the well suited label we need this kind of 'if'. Because they are multiple labels possible-
                // -around an Input.
                if ($(this).parent().find('label').eq(0).text() === '') {
                    filterLabel = $(this).parents('div:first').parent().find('label').eq(0).text();
                } else if ($(this).prop('id').includes('DateFilter')) {
                    filterLabel = $('#orderHistoryDateSelect').find('option:selected').eq(0).text() + ' ' +
                        $(this).parent().find('label').eq(0).text().replace('-', '').replace(' ', '') +  ': ';
                } else {
                    filterLabel = $(this).parent().find('label').eq(0).text();
                }


                if ($(this).is('select')) {
                    filterBox.text(filterLabel + $(this).find('option:selected').text());
                } else if ($(this).parents('#orderHistorySendByFilter').length) {
                    const sendByNameObject = {digikala: 'دیجیکالا', seller: 'فروشنده'}
                    let sendByPersianValue = sendByNameObject[$(this).val()]

                    if (!sendByPersianValue) {
                        sendByPersianValue = 'هردو';
                    }
                    filterBox.text(filterLabel + sendByPersianValue);
                } else {
                    filterBox.text(filterLabel + $(this).val());
                }

                $('#orderHistoryRemoveAllFilters').removeClass('c-order-history__search-filter--invisible')
            } else if ((($(this).val() === '' && $(this).parents('#orderHistorySendByFilter').length) || !$(this).val() || $(this).val() === '0')
                && !$('#orderHistorySearchFilterBar').hasClass('c-order-history__search-filters-bar--invisible')) {
                filterBox.trigger('click', {dontTriggerClick: true});
            }

            OrderHistorySearchAction.submitSearchForm();
        });
    },

    initHandleSearchSubItemChange: function () {
        const dateNames = [
            'search[warehouse_status_at_',
            'search[order_shipped_at_',
            'search[order_item_serial_locate_at_',
        ]

        const textNames = [
            'search[text_all]',
            'search[order_id]',
            'search[product_id]',
            'search[product_variant_supplier_code]',
            'search[product_variant_id]',
            'search[serial]',
            'search[order_item_shipment_id]',
        ]

        $('.js-order-history-search-input-part').on('change', function () {
            if ($(this).parent().prop('id') === 'orderHistoryDateSelect') {
                const fromInput  = $('#orderHistoryFromDateFilter').find(':input');
                const fromInputBox  = $('#orderHistoryFromDateFilterSelected');
                const toInput = $('#orderHistoryTillDateFilter').find(':input');
                const toInputBox = $('#orderHistoryTillDateFilterSelected');

                // Change form name of inputs to correct ones
                fromInput.prop('name', dateNames[$(this).val()] + 'from]');
                toInput.prop('name', dateNames[$(this).val()] + 'to]');

                // Change filter texts to correct ones
                fromInputBox.text($(this).find('option:selected').eq(0).text() + ' ' +
                    fromInput.parent().find('label').eq(0).text().replace('-', '').replace(' ', '') +  ': ' + fromInput.val())
                toInputBox.text($(this).find('option:selected').eq(0).text() + ' ' +
                    toInput.parent().find('label').eq(0).text().replace('-', '').replace(' ', '') +  ': ' + toInput.val())

                if (fromInput.val() || toInput.val()) {
                    OrderHistorySearchAction.submitSearchForm();
                }
            } else if ($(this).parent().parent().parent().prop('id') === 'orderHistoryTextFilter') {
                const textInputEl = $('#orderHistorySearchByText').find(':input').eq(0);
                const textInputFilterBox = $('#orderHistoryTextFilterSelected');

                textInputEl.prop('name', textNames[$(this).val()]);

                textInputFilterBox.text(
                    $(this).find('option:selected').eq(0).text().replace('همه موارد', '') + ' : ' + textInputEl.val()
                );

                if (textInputEl.val()) {
                    $('button.js-order-history-search-input').trigger('click');
                }
            }
        });
    },

    initHandleSearchTextSearch: function () {
        $('.js-order-history-search-input').on('click', function () {
            const textEl = $('#orderHistorySearchByText');
            let selectText;
            if ($(this).is('button')) {
                if (textEl.find(':input').eq(0).val() !== '') {
                    selectText = $('#orderHistoryTextFilter select').find('option:selected').eq(0).text();

                    if (selectText === 'همه موارد') {
                        selectText = '';
                    } else {
                        selectText += ' : '
                    }

                    OrderHistorySearchAction.filtersBar.removeClass('c-order-history__search-filters-bar--invisible');
                    $('#orderHistoryExcelExportButton').parent().css('top', '410px');
                    $('#orderHistoryRemoveAllFilters').removeClass('c-order-history__search-filter--invisible');
                    $('#orderHistoryTextFilterSelected')
                        .removeClass('c-order-history__search-filter--invisible')
                        .text(
                            selectText +
                            textEl.find(':input').eq(0).val()
                        );
                }

                OrderHistorySearchAction.submitSearchForm();
            }
        })
    },

    initSearchTextButtonActivation: function () {
        $('#orderHistorySearchByText').find(':input').eq(0).on('input', function () {
            if (!$(this).val || $(this).val() === '') {
                $('button.js-order-history-search-input').prop('disabled', true);
            } else {
                $('button.js-order-history-search-input').prop('disabled', false);
            }
        })

    },

    initOnRemove: function () {
        $('.js-remove-filter').on('click', function (event, object) {
            let filterInput;

            $(this).addClass('c-order-history__search-filter--invisible');

            if (!$(this).prop('id').startsWith('orderHistoryTextFilter')) {
                filterInput = $('#' + $(this).prop('id').replace('Selected', '')).find(':input').eq(0);
            } else {
                filterInput = $('#' + $(this).prop('id').replace('Selected', '')).find(':input').eq(1);
            }

            OrderHistorySearchAction.checkIfAnyFilterSelected();

            let filterInputId = filterInput.prop('id');

            // Change value to default for each type of input.
            if (filterInputId.startsWith('orderHistorySendByFilter')) {
                filterInput.parent().find(`[name='${filterInput.prop('name')}']`).eq(0)
                    .prop('checked', true);
                filterInput.parent('label').trigger('click');
            } else if (!filterInput.is('select')) {
                filterInput.val('');
            } else {
                filterInput.val(null);
            }

            if (!object || !object.dontTriggerClick) {
                if (!$(this).prop('id').startsWith('orderHistoryTextFilter')) {
                    filterInput.trigger('change');
                } else {
                    filterInput.parents('#orderHistoryTextFilter').find('button').eq(0).trigger('click').prop('disabled', true);
                }
            }
        })
    },

    checkIfAnyFilterSelected: function () {
        let deleteRow = true;

        $.each(this.filtersBar.children(), function (index, item) {
            if (!$(item).hasClass('c-order-history__search-filter--invisible') &&
                $(item).prop('id') !== 'orderHistoryRemoveAllFilters' && $(item).prop('id') !== '') {
                deleteRow = false;
            }
        });

        if (deleteRow) {
            this.filtersBar.addClass('c-order-history__search-filters-bar--invisible');
            $('#orderHistoryExcelExportButton').parent().css('top', '350px');
        }
    },

    initOnRemoveAll: function () {
        $('.js-remove-all-filters').on('click', function () {
            $('.js-remove-filter:not(.c-order-history__search-filter--invisible)').trigger('click');
        });
    }
}


$(function () {
    OrderHistoryAction.init();
})


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
