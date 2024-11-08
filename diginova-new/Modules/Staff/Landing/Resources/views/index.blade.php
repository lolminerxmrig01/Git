@extends('layouts.staff.master')
@section('head')
<script>
        var module_hash_id_storage = 1;
        var module_no_replace_update_command_status = 1;
        var module_adding_new_days_to_incredible_and_plus = 1;
        var module_daily_sellable_stock = 1;
        var module_online_shipment_cancellation = 1;
        var module_fc_supplier_invoice = 1;
        var module_internal_trade_qc = 1;
        var module_internal_trade_seller_qc = 1;
        var module_internal_trade_submit_trade = 1;
        var module_internal_trade_generate_serial = 1;
        var module_digistyle = 1;
        var module_fbs_failed_delivery_flow = 1;
        var module_marketplace_fbs_courier = 1;
        var module_marketplace_warehouse_setting_modal = 1;
        var module_digistyle_special_capacity = 1;
        var module_marketplace_reporting_and_insights = 1;
        var module_marketplace_sentry_log = 1;
        var module_marketplace_warehouse_postal_code = 1;
        var module_marketplace_show_warehouse_address_map = 1;
        var module_marketplace_village_seller_badge = 1;
        var module_marketplace_add_more_filter_on_ship_by_seller_order_page = 1;
        var module_ds_return_order = 1;
        var module_breaking_payment = 1;
        var module_orders_full_log = 1;
        var module_available_ts_for_non_plus_users = 1;
        var module_marketplace_promotion_new_features = 1;
        var module_app_break_payment = 1;
        var module_only_fresh_filter = 1;
        var module_plus_subscription_nps = 1;
        var module_plus_partnership_filimo = 1;
        var module_plus_partnership = 1;
        var module_online_return_drop_off = 1;
        var module_marketplace_sbs_excel_export = 1;
        var module_sbs_psat_sms = 1;
        var module_proof_of_delivery = 1;
        var module_ab_related_searched_words = 1;
        var module_brand_new_incredible_offers_page = 1;
        var module_fresh_offers_redesign = 1;
        var module_dk_amazing_offer_touch_point = 1;
        var module_refactor_nps_survey = 1;
        var module_shopping_setting = 1;
        var module_dk_insider_functions = 1;
        var module_dkms_premium_brand_application_mode = 1;
        var module_fbd_schedule_order = 1;
        var module_ds_shipment_pod_code = 1;
        var module_ds_post_barcode = 1;
        var module_online_return = 1;
        var module_change_comments_like_button = 1;
        var module_dc_referral_box = 1;
        var module_third_party_referral_voucher = 1;
        var module_return_outbound = 1;
        var module_ship_by_seller_verification_code_try_rate_limit = 1;
        var module_international_po = 1;
        var module_dk_set_pdp_ga = 1;
        var module_fmcg = 1;
        var module_plp_redesign = 1;
        var module_FMCG_emarsys = 1;
        var module_fake_products = 1;
        var module_digikala_fashion = 1;
        var module_digikala_news = 1;
        var module_sponsored_mega_menu = 1;
        var module_ds_redesign_profile_addresses = 1;
        var module_video_modal = 1;
        var module_main_category_amazing_data_layer = 1;
        var module_fresh_badge_basket = 1;
        var module_rostaee_badge = 1;
        var module_revised_sellers_promotions_price = 1;
        var module_new_post = 1;
        var module_ab_pdp_back_to_cart = 1;
        var module_dynamic_fashion_category = 1;
        var module_product_change_queue_entity = 1;
        var module_package_gate = 1;
        var module_faq_short_answer = 1;
        var module_gallery_zoom = 1;
        var module_enable_fast_excel = 1;
        var module_fc_split_receipt_item = 1;
        var module_seller_bank_account_refactor = 1;
        var module_shipment_cost_bar = 1;
        var module_adro_tracker_sales = 1;
        var module_adro_banner_placement = 1;
        var module_new_home_and_kitchen_widget_design = 1;
        var module_bellatrix_dynamic_widget = 1;
        var module_product_redesign = 1;
        var module_sponsoredAd = 1;
        var module_share_invoice = 1;
        var module_digikala_profile_return = 1;
        var module_bank_card_redesign = 1;
        var module_faq_tab_redesign = 1;
        var module_comments_file = 1;
        var module_increase_comment_video_limit_count = 1;
        var module_contact_design = 1;
        var module_dk_contact_redesign = 1;
        var module_digiclub_touchpoints = 1;
        var module_digiclub_touchpoints_september = 1;
        var module_digiclub_luckydraw_stopped = 1;
        var module_digiclub_promotion = 1;
        var module_digiclub_new_header = 1;
        var module_digiclub_lucky_spinner = 1;
        var module_digiclub_multiple_shipment = 1;
        var module_digiclub_new_info = 1;
        var module_digiclub_shipping_points = 1;
        var module_digiclub_birthday_anniversary_gift_points = 1;
        var module_digiclub_game_center = 1;
        var module_digiclub_game_center_content = 1;
        var module_digiclub_mission_page = 1;
        var module_plp_shortcut_and_touchpoint_filter = 1;
        var module_marketplace_orders_ovl = 1;
        var module_marketplace_ovl = 1;
        var module_modal_add_to_cart = 1;
        var module_size_guide_new = 1;
        var module_marketplace_request_invoices_export = 1;
        var module_faq_feedback = 1;
        var module_marketplace_remove_active_field_from_bank_account_entity = 1;
        var module_cart_details_new_design = 1;
        var module_seven_days_warranty = 1;
        var module_crm_after_sale = 1;
        var module_sms_comments_file = 1;
        var module_user_history = 1;
        var module_Adro_sponsoredAd = 1;
        var module_search_new_style = 1;
        var module_new_shipping = 1;
        var module_set_order_type_ga = 1;
        var module_qa_moderation = 1;
        var module_js_crashlytics = 1;
        var module_marketplace_electronic_contract = 1;
        var module_marketplace_electronic_contract_admin_side = 1;
        var module_premium_brand = 1;
        var module_merge_accounts = 1;
        var module_dkms_new_brand = 1;
        var module_adservice_digikala_premium_brand = 1;
        var module_adservice_digikala_premium_brand_improvement = 1;
        var module_desktop_sis = 1;
        var module_mobile_sis = 1;
        var module_footer_new_social_links = 1;
        var module_new_registration = 1;
        var module_new_desktop_header = 1;
        var module_general_location = 1;
        var module_pdp_redesign_new_variant = 1;
        var module_top_banner_make_unsticky = 1;
        var module_ds_voucher_box = 1;
        var module_yalda_box = 1;
        var module_dkms_brand_campaign = 1;
        var module_order_item_modification = 1;
        var module_voucher_fraud_prevention = 1;
        var module_marketplace_package_wh_capacity = 1;
        var module_address_landline = 1;
        var module_dk_wallet = 1;
        var module_product_box_cpc_redesign = 1;
        var module_ab_desktop_touchpoint_filters = 1;
        var module_dk_wallet_cash_back = 1;
        var module_admin_marketplace_seller_edit_address = 1;
        var module_marketplace_seller_sort_warehouses = 1;
        var module_marketplace_seller_registration_address = 1;
        var module_DS_megamenu_redesign = 1;
        var module_marketplace_seller_profile_wh = 1;
        var module_new_carousel_price = 1;
        var module_ga_shipping_carousel_add_to_cart = 1;
        var module_ds_seller = 1;
        var module_ds_seller_new = 1;
        var module_adservice_sku_price = 1;
        var module_ds_special_sale = 1;
        var module_promotion_mega_menu = 1;
        var module_add_item = 1;
        var module_cancel_item = 1;
        var module_category_product_types = 1;
        var module_marketplace_hidden_category_panel = 1;
        var module_ds_mobile_web_mega_menu_redesign = 1;
        var module_pdp_digikala_rate = 1;
        var module_vouchers_order_count = 1;
        var module_marketplace_buy_box_usage_log = 1;
        var module_mobile_carousels_fast_shopping = 1;
        var module_DK_Recommendation = 1;
        var module_dk_mobile_contact_redesign = 1;
        var module_contact_change_upload_logic = 1;
        var module_retail_buy_box_challenge = 1;
        var module_adro_digistyle_affiliate = 1;
        var module_profile_topup = 1;
        var module_new_bill = 1;
        var module_refactor_shipping = 1;
        var module_new_payment = 1;
        var module_minicart_red_button = 1;
        var module_marketplace_order_package_mapping = 1;
        var module_new_gallery = 1;
        var module_mobile_new_gallery = 1;
        var module_price_chart_scale = 1;
        var module_marketplace_large_item_hub_time_scope_modification = 1;
        var module_new_add_btn = 1;
        var module_yalda_home = 1;
        var module_marketplace_info_footer = 1;
        var module_new_gallery_icons = 1;
        var module_adro_sponsor_badge_banner = 1;
        var module_adro_sponsor_badge_banner_fashion = 1;
        var module_yalda_cash_back = 1;
        var module_new_empty_cart = 1;
        var module_dkms_brand_campaign_redesign = 1;
        var module_cpo_new_search = 1;
        var module_cpo_winner_buy_box = 1;
        var module_pdp_large_item = 1;
        var module_packaging_info = 1;
        var module_marketplace_order_detail = 1;
        var module_remove_title_mandatory = 1;
        var module_cpo_new_rules = 1;
        var module_marketplace_seller_cpo_access_restriction = 1;
        var module_my_dk_navbar = 1;
        var module_ds_new_home = 1;
        var module_product_new_image = 1;
        var module_marketplace_lead_time_in_category = 1;
        var module_brand_iranian_designer = 1;
        var module_shopping_new_incredible_categories = 1;
        var module_marketplace_promotion_management = 1;
        var module_modify_reference_price_rules = 1;
        var module_shopping_fresh_in_incredible_carousel = 1;
        var module_DK_DC_navigation = 1;
        var module_marketplace_price_tag = 1;
        var module_adservice_banner_sort = 1;
        var module_new_chat_client = 1;
        var module_new_chat_client_ajax = 1;
        var module_parsi_map = 1;
        var module_new_address_modal = 1;
        var module_new_profile_addresses = 1;
        var module_new_profile_gift_card = 1;
        var module_new_profile_user_history = 1;
        var module_new_checkout_address = 1;
        var module_address_geolocation = 1;
        var module_adservice_incredible_offer_eligible_variant = 1;
        var module_paste_barcode_copied = 1;
        var module_ds_faq_dynamic = 1;
        var module_new_lead_time_text = 1;
        var module_digistyle_special_event = 1;
        var module_digistyle_voucher_spinner = 1;
        var module_cart_sampling_gift = 1;
        var module_ds_favorite_brands = 1;
        var module_new_user_history = 1;
        var module_ds_new_add_to_cart = 1;
        var module_light_box = 1;
        var module_fmcg_navigation = 1;
        var module_marketplace_moderation_category_suggestion_modal = 1;
        var module_video_js = 1;
        var module_marketplace_new_seller_dashboard = 1;
        var module_large_item_shipping_fee = 1;
        var module_new_address_improvement = 1;
        var module_seller_notification_changing_email = 1;
        var module_profile_list = 1;
        var module_premium_brand_bullet_points = 1;
        var module_shared_address = 1;
        var module_pdp_seller_rate_info_modal = 1;
        var module_dimension_config_validation = 1;
        var module_ds_update_cart_when_removed = 1;
        var module_ds_profile_icon_dropdown = 1;
        var module_ds_default_size_none = 1;
        var module_ds_faq_new = 1;
        var module_ab_test_plp_rating = 1;
        var module_ds_employee_discount = 1;
        var module_ds_next_purchase_counter_update = 1;
        var module_admin_warranty_insurance = 1;
        var module_new_profile_orders = 1;
        var module_new_profile_sidebar = 1;
        var module_delete_comment = 1;
        var module_ds_refresh_when_phone_edit = 1;
        var module_new_market_price_rules = 1;
        var module_ds_only_banner_logo = 1;
        var module_ds_banner_description_scroll = 1;
        var module_digiplus_pdp = 1;
        var module_digiplus_plp = 1;
        var module_digiplus_navigation = 1;
        var module_digiplus_checkout = 1;
        var module_digiplus_timescope = 1;
        var module_digiplus_shipping = 1;
        var module_digiplus_filter = 1;
        var module_digiplus_incredible = 1;
        var module_digiplus_profile = 1;
        var module_digiplus_carousel = 1;
        var module_digiplus_tnc = 1;
        var module_digiplus_cashback = 1;
        var module_digiplus_notifications = 1;
        var module_digikala_plus_service = 1;
        var module_plus_free_shipping = 1;
        var module_digiplus_rebrand = 1;
        var module_digiplus_public = 1;
        var module_digiplus_badge = 1;
        var module_digiplus_promotion_cb = 1;
        var module_marketplace_profile_refactor = 1;
        var module_ds_next_for_non_logged_users = 1;
        var module_sfl_separation = 1;
        var module_esi_in_mini_header = 1;
        var module_ds_comment_for_non_logged = 1;
        var module_ds_mobile_full_footer = 1;
        var module_banner_url_check = 1;
        var module_ds_mobile_comment_verfication = 1;
        var module_ds_mobile_back_menu = 1;
        var module_ds_new_mobile_header = 1;
        var module_new_mobile_header = 1;
        var module_new_ds_brands = 1;
        var module_dk_mobile_menu_revision = 1;
        var module_ds_plp_redesign = 1;
        var module_voucher_fraud_detection = 1;
        var module_marketplace_dk_pickup_shipment = 1;
        var module_marketplace_create_package_shipment = 1;
        var module_shipment_effect_create_package = 1;
        var module_recaptcha_contact_us = 1;
        var module_ds_mega_menu_redesign = 1;
        var module_data_layer = 1;
        var module_data_layer_carousels = 1;
        var module_data_layer_phase2 = 1;
        var module_data_layer_my_landing = 1;
        var module_checkout_action_button_replacement = 1;
        var module_ds_shipment_back = 1;
        var module_new_comment = 1;
        var module_new_profile_orders_mobile = 1;
        var module_new_price_chart_header = 1;
        var module_ds_comment_errors = 1;
        var module_mobile_time_table = 1;
        var module_admin_new_ship_by_seller = 1;
        var module_ship_by_seller_profile = 1;
        var module_shipping_v2 = 1;
        var module_ship_by_seller_checkout = 1;
        var module_ship_by_seller_product = 1;
        var module_new_cpo_icon_config = 1;
        var module_separated_delete_button = 1;
        var module_new_profile_notification = 1;
        var module_ds_favorite_list = 1;
        var module_mandatory_location_shipping = 1;
        var module_ds_minicart_redesign = 1;
        var module_sfl_inactive_product = 1;
        var module_marketplace_ship_by_seller_pdp = 1;
        var module_drop_off = 1;
        var module_new_profile_additional_info = 1;
        var module_new_profile_additional_info_mobile = 1;
        var module_new_vat_rule = 1;
        var module_seller_live_date = 1;
        var module_plp_top_filters = 1;
        var module_cbr_unsatisfied_users = 1;
        var module_chatbox_all_pages = 1;
        var module_display_inactive_products = 1;
        var module_update_product_site_excel = 1;
        var module_ds_faq_new_mobile = 1;
        var module_stop_sending_email_sms_to_sellers = 1;
        var module_nps_ship_by_seller = 1;
        var module_new_login = 1;
        var module_cpo_import_excel = 1;
        var module_refund_end_to_end = 1;
        var module_ship_by_seller_ovl = 1;
        var module_collective_promotions_module = 1;
        var module_selection_pricing = 1;
        var module_dynamic_shipping_cost = 1;
        var module_ds_category_filter = 1;
        var module_sbs_failed_delivery = 1;
        var module_jet_delivery = 1;
        var module_amazing_carousel_show_all = 1;
        var module_marketplace_seller_data = 1;
        var module_new_economic_profile = 1;
        var module_jet_delivery_filter = 1;
        var module_new_burger_menu = 1;
        var module_ds_home_rearrange = 1;
        var module_ds_pdp_cart_header = 1;
        var module_new_cmp_category = 1;
        var module_auto_title_suggestion = 1;
        var module_dk_rebranding = 1;
        var module_rebrand_border_radius = 1;
        var module_variant_restrictions = 1;
        var module_new_question_gallery = 1;
        var module_ds_seller_pdp_redesign = 1;
        var module_ds_comment_redesign = 1;
        var module_ds_pdp_redesign_f = 1;
        var module_add_imei_to_packages = 1;
        var module_new_thank_you = 1;
        var module_thankyou_without_action = 1;
        var module_ds_mega_menu_beauty = 1;
        var module_cart_swiper_ab_test = 1;
        var module_cpo_excel_import = 1;
        var module_ml_profile_ab_test = 1;
        var module_sbs_delivery_send_delivered_sms = 1;
        var module_new_contact_us = 1;
        var module_new_ds_contact_us = 1;
        var module_carousel_brand_campaign = 1;
        var module_ds_beatuy_new_badge = 1;
        var module_ds_design_improve = 1;
        var module_jet_delivery_variant_dimension = 1;
        var module_mobile_back_btn_position = 1;
        var module_ds_install_app = 1;
        var module_only_seller_shipping_type = 1;
        var module_checkout_ship_by_seller_phase_2 = 1;
        var module_ds_new_forget_pass_email = 1;
        var module_ds_product_image_zoom = 1;
        var module_only_fbs = 1;
        var module_hoda_verification = 1;
        var module_ds_new_auth = 1;
        var module_share_new_option = 1;
        var module_ds_order_history = 1;
        var module_ds_order_details = 1;
        var module_marketplace_ship_by_seller_order_new_sort = 1;
        var module_auto_assign_products_photo = 1;
        var module_unavailable_payment_method_ab_test = 1;
        var module_ds_order_history_dt = 1;
        var module_ds_profile_components = 1;
        var module_ds_order_search = 1;
        var module_ds_order_search_dt = 1;
        var module_marketplace_new_passive_order = 1;
        var module_content_x = 1;
        var module_shortcut_filters = 1;
        var module_revamp_product = 1;
        var module_new_shipping_limit_modal = 1;
        var module_new_app_adjust_links = 1;
        var module_marketplace_profile_rating = 1;
        var module_only_fbs_deactive_variant = 1;
        var module_insider_object = 1;
        var module_search_banner_ga = 1;
        var module_seo_search_pages = 1;
        var module_app_specific_incredible = 1;
        var module_marketplace_finance_wallet = 1;
        var module_ds_impression_click_install_app = 1;
        var module_marketplace_wallet = 1;
        var module_long_time_declare = 1;
        var module_edit_product_price_amazing = 1;
        var module_marketplace_lazy_load_images_cmp = 1;
        var module_ship_by_seller_post = 1;
        var module_deactive_empty_promotions = 1;
        var module_sponsored_ads = 1;
        var module_seller_landing_redesign = 1;
        var module_ab_pdp_view_count = 1;
        var module_pdp_concurrent_viewer_phase1 = 1;
        var module_ship_by_seller_total_capacity_remained_calculator = 1;
        var module_new_ship_by_seller_setting = 1;
        var module_marketplace_ship_by_seller_settings = 1;
        var module_marketplace_ship_by_seller_free_shipping = 1;
        var module_marketplace_fix_registration_fmcg_bug = 1;
        var module_post_next_day_checkout = 1;
        var module_IMEI_demo = 1;
        var module_main_cat_amazing = 1;
        var module_mc_provider_filter = 1;
        var module_dk_mobile_header_redesign = 1;
        var module_commission_discount = 1;
        var module_commission_discount_end_date = 1;
        var module_automatic_approval_shared_promotions = 1;
        var module_marketplace_fix_image_problem_on_responsive = 1;
        var module_product_config_multi_select = 1;
        var module_marketplace_ship_by_seller_restriction = 1;
        var module_new_bazaar_logo = 1;
        var module_download_app_row_redesign = 1;
        var module_product_is_iranian = 1;
        var module_ciri_new_design = 1;
        var module_plp_new_filters = 1;
        var module_new_customer_landing = 1;
        var module_iban = 1;
        var module_marketplace_product_config_sortable_product_id = 1;
        var module_marketplace_profile_commitment_download_link = 1;
        var module_pause_brand_campaign_with_out_of_stock_dkp = 1;
        var module_sbs_carousels = 1;
        var module_content_config = 1;
        var module_sbs_improvement = 1;
        var module_data_layer_ds = 1;
        var module_dimensions_required_cf_view = 1;
        var module_magic_refrigerator_landing = 1;
        var module_village_landing_form = 1;
        var module_anonymous_comment = 1;
        var module_marketplace_profile_persian_digits_contact_info = 1;
        var module_new_shipping_fresh_carousel = 1;
        var module_marketplace_remove_adservice_buttons_product_config = 1;
        var module_seller_voucher_submit_type = 1;
        var module_marketplace_product_config_archive_badge = 1;
        var module_package_delete = 1;
        var module_marketplace_delete_package_modal_and_changes = 1;
        var module_search_banner_command = 1;
        var module_mobile_compare = 1;
        var module_sample_gift = 1;
        var module_fc_supply_payment_new_print = 1;
        var module_cart_simplify = 1;
        var module_marketplace_orders_manual_tracking_code = 1;
        var module_new_dkms_promotion_details_columns = 1;
        var module_ad_expiry_date = 1;
        var module_marketplace_registration_post_number_validation = 1;
        var module_ccp_guideline = 1;
        var module_periodic_prices_acl = 1;
        var module_yalda_99_timer = 1;
        var module_yalda_99_carousels = 1;
        var module_rejected_packages = 1;
        var module_best_selling_data_layer = 1;
        var module_marketplace_seller_page_refactor = 1;
        var module_ovl_refactor = 1;
        var module_product_first_party_updater = 1;
        var module_marketplace_profile_description_and_logo_changes = 1;
        var module_new_attribute_structure = 1;
        var module_sale_restriction_reason = 1;
        var module_just_approved_product_can_be_active = 1;
        var module_plus_cashback_per_item = 1;
        var module_auto_title_enable_edit = 1;
        var module_unpause_valid_brand_campaigns = 1;
        var module_marketplace_fix_create_package_process_ui = 1;
        var module_promotion_filter_by_seller = 1;
        var module_seller_calender_change = 1;
        var module_marketplace_create_package_gregorian_date = 1;
        var module_marketplace_package_details_expiration_and_fixes = 1;
        var module_marketplace_create_package_new_shelf_life = 1;
        var module_marketplace_show_hoda_modal = 1;
        var module_profile_return_invoice = 1;
        var module_product_class = 1;
        var module_sbs_checkout_post = 1;
        var module_marketplace_registration_persian_numbers = 1;
        var module_ship_by_post_only_small_nature = 1;
        var module_marketplace_ship_by_post_routes = 1;
        var module_fbs_for_all = 1;
        var module_seller_restriction_excel_import = 1;
        var module_mobile_shipping_fresh_recommendation = 1;
        var module_search_bar_banner = 1;
        var module_new_pdp_review = 1;
        var module_dk_pdp_redesign = 1;
        var module_new_pdp_sellers = 1;
        var module_new_profile_favorites = 1;
        var module_dk_pdp_improve = 1;
        var module_digi_birthday_99 = 1;
        var module_dk_birthday_referral = 1;
        var module_profile_return_invoice_list = 1;
        var module_delivery_tracking_status = 1;
        var module_video_bulk = 1;
        var module_business_name = 1;
        var module_change_supplier_status_in_excel_import = 1;
        var module_dpo_update_price = 1;
        var module_fulfillment_dpo_rts_validation = 1;
        var module_seller_first_party_updater = 1;
        var module_new_customer_floating_box = 1;
        var module_lead_time_postpone = 1;
        var module_dynamic_shipping_cost_phase_2 = 1;
        var module_new_desktop_time_table = 1;
        var module_similar_brand = 1;
        var module_plp_mobile_fidibo_banner = 1;
        var module_custom_payment_plus = 1;
        var module_asserting_pricing_rules_in_po = 1;
        var module_year_end_99 = 1;
        var module_chatbot = 1;
        var module_ds_refund_modals = 1;
        var module_plp_on_promotion = 1;
        var module_order_limit_on_plus_promotions = 1;
        var module_ad_service_separate_plus_amazing_duration = 1;
        var module_duration_time_between_plus_amazing_and_amazing = 1;
        var module_threshold_duration_auto_amazing = 1;
        var module_add_app_banners_for_premium_brand = 1;
        var module_dkms_sponsor_brand_description_and_weight = 1;
        var module_special_amazing_on_app = 1;
        var module_disabled_max_allowable_price_assertion_in_active_amazing = 1;
        var module_new_max_allowable_price_for_incredible = 1;
        var module_adding_tags_to_sponsor_brand_campaigns = 1;
        var module_convert_search_brand_name_to_persian_chars = 1;
        var module_mc_router = 1;
        var module_cpc_tapsell = 1;
        var module_cpc_yektanet = 1;
        var module_mega_promotion_automation = 1;
        var module_log_missing_translations = 1;
        var module_marketplace_cc = 1;
        var module_marketplace_login_captcha = 1;
        var module_new_reports_page = 1;
        var module_cpo_batch_upload_new = 1;
        var module_split_inbound_capacity = 1;
        var module_marketplace_seller_holiday_for_ship_by_seller = 1;
        var module_sbs_order_log = 1;
        var module_cpc_modal_use_ajax_for_fetching_data = 1;
        var module_marketplace_wallet = 1;
</script>
<script>
    var supernova_mode = "production";
    var supernova_tracker_url = "";
    var showRejectedMessage = 0;
    var rejectedMessage = "";
    var isLoggedSeller = 1;
    var walkthroughSteps = [];
    var showPriceModal = 0;
    var newSeller = 1;
    var is_yalda = 0;
</script>
<script src="{{ asset('mehdi/staff/js/tableView.js') }}"></script>
<script src="https://unpkg.com/jalali-moment/dist/jalali-moment.browser.js"></script>
@endsection
@section('content')
<main class="c-main">
        <div class="uk-container uk-container-large">
            <div class="c-grid c-join__grid">
                <div class="c-grid__row c-join__top-details c-join__top-details--sm">
                    <div class="c-grid__col c-join__flex-space-between">
                        <h1 class="c-card__title c-card__title--dark c-card__title--desc c-add-products__title">
                            صفحه سفارشی
                            <span class="c-card__title-sub c-card__title-sub--no-spacing">صفحه سفارشی جدید بسازید و یا صفحه‌های سفارشی ساخته شده را ویرایش کنید.</span></h1>
                            <a href="{{ route('staff.landings.create') }}" class="c-join__btn c-join__btn--secondary-greenish c-join__btn--icon-left c-join__btn--icon-plus">
                            ساخت صفحه سفارشی
                        </a>
                    </div>
                </div>

                <div class="c-grid__row">
                    <div class="c-grid__col">
                        <div class="c-card">
                            <div class="c-card__header">
                                <div class="c-grid__col">
                                    <h2 class="c-card__title">صفحه‌های سفارشی ساخته‌شده</h2>
                                </div>
                            </div>
                            <div class="c-card__body">
                                <div class="c-grid__col">
                                    <div class="c-grid__col c-promo__tab-container c-promo__tab-container--is-visible" data-tab="1">

                                        <div class="c-grid__row c-promo__has-divider">
                                            <form class="c-ui-form c-join__manage-filters" id="searchForm">
                                                <div class="c-ui-form__row">
                                                    <div class="c-ui-form__col c-ui-form__col-4">
                                                        <label class="c-ui-form__label">جستجو:</label>
                                                        <div class="c-ui-input">
                                                            <input type="search" name="title" class="c-ui-input__field c-ui-input__field--order js-form-clearable c-join__input" id="search_input" placeholder="جستجوی نام صفحه" style="width: 400px;">
                                                            <button class="uk-icon-button c-join__search-btn uk-icon" uk-tooltip="title: جستجو;" uk-icon="icon: search" id="submitButton" title="" aria-expanded="false"><svg width="20" height="20" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" ratio="1"> <circle fill="none" stroke="#000" stroke-width="1.1" cx="9" cy="9" r="7"></circle> <path fill="none" stroke="#000" stroke-width="1.1" d="M14,14 L18,18 L14,14 Z"></path></svg></button>
                                                        </div>
                                                    </div>

                                                    <span class="c-ui-form__col c-ui-form__col--group-item" style="width: 215px">
                                                        <label for="form-field-start_at" class="c-ui-form__label">تاریخ و زمان شروع</label>
                                                        <input class="uk-input c-ui-input__field c-ui-input__field--order js-promotion-date-picker pwt-datepicker-input-element" data-format="LLLL" data-time="1" data-from-today="0" data-date="1" data-name="start_at" value="" id="form-field-dt-36491" autocomplete="off">
                                                        <input name="start_at" id="start_at" type="hidden" value="">
                                                    </span>

                                                    <span class="c-ui-form__col c-ui-form__col--group-item" style="width: 215px">
                                                        <label for="form-field-end_at" class="c-ui-form__label">تاریخ و زمان پایان</label>
                                                        <input class="uk-input c-ui-input__field c-ui-input__field--order js-promotion-date-picker pwt-datepicker-input-element" data-format="LLLL" data-time="1" data-from-today="0" data-date="1" data-name="end_at" value="" id="form-field-dt-25286" autocomplete="off">
                                                        <input name="end_at" id="end_at" type="hidden" value="">
                                                    </span>

                                                </div>
                                            </form>
                                        </div>

                                        <div class="js-table-container" id="product-list-items">
                                            <br>
                                            <div class="c-ui-paginator js-paginator">
                                                <div class="c-ui-paginator__total" data-rows="{{ persianNum(count($landings)) }}" style="margin-left: 25px;">
                                                    تعداد نتایج: <span>{{ persianNum($landings->total()) }} مورد</span>
                                                </div>
                                            </div>

                                            <div class="c-grid__row c-promo__row--m-sm">
                                                <table class="c-ui-table c-join__table  js-search-table js-table-fixed-header" data-sort-column="created_at" data-sort-order="desc" data-search-url="{{ route('staff.landings.searchLanding') }}" data-auto-reload-seconds="0" data-new-ui="1" data-is-header-floating="1" data-has-checkboxes="">
                                                    <thead>
                                                    <tr class="c-ui-table__row">
                                                        <th class="c-ui-table__header  ">
                                                            <span class="js-search-table-column">عنوان صفحه فرود</span>
                                                        </th>
                                                        <th class="c-ui-table__header c-ui-table__header--nowrap ">
                                                            <span class="js-search-table-column">لینک صفحه فرود</span>
                                                        </th>
                                                        <th class="c-ui-table__header c-ui-table__header--nowrap ">
                                                            <span class="js-search-table-column-sortable table-header-searchable" data-sort-column="start_end_at" data-sort-order="desc">تاریخ نمایش صفحه فرود</span>
                                                        </th>
                                                        <th class="c-ui-table__header  ">
                                                            <span class="js-search-table-column">وضعیت کالاها</span>
                                                        </th>
                                                        <th class="c-ui-table__header  ">
                                                            <span class="js-search-table-column">فعال / غیرفعال</span>
                                                        </th>
                                                        <th class="c-ui-table__header c-ui-table__header--nowrap ">
                                                            <span class="js-search-table-column">عملیات</span>
                                                        </th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @if(count($landings))
                                                      @foreach($landings as $landing)
                                                        <tr class="c-ui-table__row c-ui-table__row--body c-join__table-row">
                                                        <td class="c-ui-table__cell">
                                                            <div style="font-weight: bold;">{{ $landing->name }}</div>
                                                            <div class="c-join__landing-state c-ui-table__cell--text-warning">
                                                                @if($landing->end_at < now())
                                                                <span class="c-join__has-icon c-join__has-icon--clock"  style="padding-right: 25px;">پایان یافته</span>
                                                                @endif
                                                            </div>
                                                        </td>
                                                        <td class="c-ui-table__cell c-ui-table__cell--text-blue">
                                                            <a class="c-join__promotion-link" href="{{ $site_url . '/product-list/' . $landing->slug }}" target="_blank">{{ $site_url . '/product-list/' . $landing->slug }}</a>
                                                            <a class="c-join__promotion-copy-btn js-copy-btn" href="#" data-link="{{ $site_url . '/product-list/' . $landing->slug }}">کپی لینک</a>
                                                        </td>
                                                        <td class="c-ui-table__cell c-join-promotion__date-range">
                                                            <span class="c-ui-table__date-f rom span-time" data-value="{{ $landing->start_at }}" data-type="شروع"></span>
                                                            <br>
                                                            <span class="c-ui-table__date-to span-time" data-value="{{ $landing->end_at }}" data-type="پایان"></span>
                                                        </td>
                                                        <td class="c-ui-table__cell">
                                                            <div class="c-join__status-cell">
                                                                @php
                                                                    $ziro_count = $landing->productVariants()->where('stock_count', 0)->get();
                                                                    $true_count = $landing->productVariants()->where('stock_count', '>' , 0)->get();
                                                                @endphp
                                                                @if(!is_null($ziro_count) && count($ziro_count))
                                                                  <span class="c-join__status"><span class="c-join__status-counter c-join__status-counter--approving"></span>ناموجود</span>
                                                                @endif
                                                                @if(!is_null($true_count) && count($true_count))
                                                                  <span class="c-join__status"><span class="c-join__status-counter c-join__status-counter--approved"></span>موجود</span>
                                                                @endif
                                                            </div>
                                                        </td>
                                                        <td class="c-ui-table__cell c-ui-table__cell--small-text">
                                                            <div class="c-ui-tooltip__anchor">
                                                                <div class="c-ui-toggle__group">
                                                                    <label class="c-ui-toggle">
                                                                        <input class="c-ui-toggle__origin js-toggle-active-product" type="checkbox" data-id="{{ $landing->id }}" name="status" {{ ($landing->status)? 'checked' : '' }}>
                                                                        <span class="c-ui-toggle__check"></span>
                                                                    </label>
                                                                </div>
                                                                <input type="hidden" value="0" class="js-active-input">
                                                            </div>
                                                        </td>
                                                        <td class="c-ui-table__cell">
                                                            <div class="c-promo__actions">
                                                                <a class="c-join__btn c-join__btn--icon-left c-join__btn--icon-edit c-join__btn--secondary-greenish" href="{{ route('staff.landings.manage', ['id' => $landing->id]) }}">ویرایش</a>
                                                                <button class="c-join__btn c-join__btn--icon-right c-join__btn--icon-delete c-join__btn--primary js-remove-plp js-remove-product-list" data-url="{{ route('staff.landings.removeLanding', ['id' => $landing->id]) }}">حذف صفحه</button>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                      @endforeach
                                                    @endif
                                                    </tbody>
                                                </table>
                                                <div class="c-card__loading"></div>

                                            </div>
                                            <br>


                                            <div class="c-card__footer" style="width: auto;">
                                                <a href="#" style="visibility: hidden;">
                                                    <div class="c-mega-campaigns__btns-green-plus uk-margin-remove">
                                                    </div>
                                                </a>

                                                {{ $landings->links('stafflanding::layouts.pagination.custom-pagination') }}
                                                <div class="c-ui-paginator js-paginator">
                                                    <div class="c-ui-paginator js-paginator">
                                                        @if(count($landings))
                                                            <div class="c-ui-paginator__total" data-rows="">
                                                                تعداد نتایج: <span>{{ persianNum($landings->total()) }} مورد</span>
                                                            </div>
                                                        @else
                                                            <div class="c-ui-paginator__total" data-rows="۰">
                                                                جستجو نتیجه‌ای نداشت
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>

                                            </div>


                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
</main>
@endsection
@section('script')
<script>
// توکن csrf
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

function persianNum() {
    String.prototype.toPersianDigits= function(){
        var id= ['۰','۱','۲','۳','۴','۵','۶','۷','۸','۹'];
        return this.replace(/[0-9]/g, function(w){
            return id[+w]
        });
    }
}
function convertDate() {
    $(".span-time").each(function (){
        var output="";
        var input = $(this).attr('data-value');
        var m = moment(input);
        if(m.isValid()){
            m.locale('fa');
            output = $(this).attr('data-type') + ' ' + m.format("YYYY/M/D HH:mm");
        }
        $(this).text(output.toPersianDigits());
    });
}

persianNum();
convertDate();


$(document).on('change', 'input[name="status"]', function () {
    if($(this).is(':checked'))
    {
        var status = 1;
    }
    else{
        var status = 0;
    }
    var data_id = $(this).attr('data-id');

    $.ajax({
        method: 'post',
        url: "{{ route('staff.landings.statusGroup') }}",
        data: {
            'status': status,
            'id' : data_id,
        }
    });
});



</script>
@endsection
