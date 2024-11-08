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
<script src="{{ asset('mehdi/staff/js/promotions.js') }}"></script>
<style>
.c-grid__col--gap-lg {
    padding-left: 5px !important;
    padding-right: 5px !important;
}
</style>
@endsection

@section('content')
<main class="c-content-layout">
    <div class="uk-container uk-container-large">

        <div class="c-grid c-join__grid">
            <div class="c-grid__row">
                <div class="c-grid__col">
                    <div class="c-card c-card--transparent">
                        <h1 class="c-card__title c-card__title--dark c-card__title--desc">ایجاد صفحه سفارشی
                            <span class="c-card__title-sub c-card__title-sub--no-spacing">از این صفحه می‌توانید صفحه سفارشی خود را ایجاد کنید.</span>
                        </h1>
                    </div>
                </div>
            </div>

            <div class="c-grid__row js-table-container" id="table-view-container">
                <div class="c-grid__col">
                    <div class="c-card c-card--padding">
                        <div class="c-card__wrapper">

                            <div class="c-add-products__header-section" style="border:none;">
                                <h3 class="c-add-products__title" style="margin-bottom: 25px !important;">ایجاد صفحه سفارشی</h3>

                                <form class="js-create-plp-form">
                                    <div class="c-grid__col c-grid__col--gap-lg c-grid__col--row-attr c-grid__col--flex-initial c-grid__col--sm-6" style="width: 400px !important;float: right;">
                                        <label class="c-ui-form__label" for="product_page_title">نام صفحه سفارشی</label>
                                        <label>
                                            <div class="c-ui-input">
                                                <input type="text" name="name" value="" class="c-ui-input__field c-ui-input__field--order c-ui-input__field--has-btn js-form-clearable" id="product_page_title" placeholder="نام صفحه سفارشی">
                                            </div>
                                        </label>
                                    </div>


                                    <div class="c-grid__col c-grid__col--gap-lg c-grid__col--row-attr c-grid__col--flex-initial c-grid__col--sm-6" style="width: 215px;float: right;">
                                        <label for="form-field-productList[start_at]" class="c-ui-form__label">تاریخ و زمان شروع</label>
                                        <input class="uk-input c-ui-input__field c-ui-input__field--order js-promotion-date-picker pwt-datepicker-input-element" data-format="LLLL" data-time="1" data-from-today="1" data-date="1" data-name="productList_start_at_" value="" id="form-field-dt-26888" autocomplete="off">
                                        <input name="start_at" id="productList_start_at_" type="hidden" value="2021-03-11 20:06:48">
                                    </div>

                                    <div class="c-grid__col c-grid__col--gap-lg c-grid__col--row-attr c-grid__col--flex-initial c-grid__col--sm-6" style="width: 215px;float: right;">
                                        <label for="form-field-productList[end_at]" class="c-ui-form__label">تاریخ و زمان پایان</label>
                                        <input class="uk-input c-ui-input__field c-ui-input__field--order js-promotion-date-picker pwt-datepicker-input-element" data-format="LLLL" data-time="1" data-from-today="1" data-date="1" data-name="productList_end_at_" value="" id="form-field-dt-93319" autocomplete="off">
                                        <input name="end_at" id="productList_end_at_" type="hidden" value="2021-03-10 20:06:48">
                                    </div>

                                    <div class="c-grid__col c-grid__col--gap-lg c-grid__col--row-attr c-grid__col--flex-initial c-grid__col--sm-6" style="float: right;width: 166px;" data-select2-id="4">
                                        <label class="c-ui-form__label" for="product_page_title">وضعیت</label>
                                        <select id="product-status" class="dropdown-control c-ui-select c-ui-select--common c-ui-select--small select2-hidden-accessible" name="status" data-select2-id="product-status" tabindex="-1" aria-hidden="true" style="width: 150px ​!important;">
                                            <option class="option-control" value="1" selected="">فعال</option>
                                            <option class="option-control" value="0">غیرفعال</option>
                                        </select>
                                    </div>

                                    <div class="product-form">
                                        <div class="c-grid__col c-grid__col--gap-lg c-grid__col--row-attr c-grid__col--flex-initial c-grid__col--sm-6">
                                            <label class="uk-form-label uk-flex uk-flex-between">
                                                نامک
                                            </label>
                                            <div class="field-wrapper" style="width: 605px;">
                                                <input type="text" class="c-ui-input__field c-ui-input__field--order c-ui-input__field--has-btn js-form-clearable url-inputs" name="slug" dir="ltr">
                                                <input type="button" id="button-urls" style="width: auto;" class="c-ui-tag__submit js-tag-submit-btn button-urls" value="{{ '/' . $site_url . '/product-list' }}" disabled="">
                                            </div>
                                            <div>
                                            </div>
                                        </div>
                                    </div>
                                </form>

                                <div class="c-join__buttons">
                                    <button class="c-join__btn c-join__btn--secondary c-join__btn--secondary-greenish c-join__btn--icon-left js-save-list-page-button">تایید و ساخت صفحه سفارشی</button>
                                </div>
                                <div class="c-join__loading c-loading c-loading--hidden">
                                    <div class="c-loading__container">
                                        <div class="loading"></div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="js-select-products" uk-modal="esc-close: true; bg-close: true;" class="uk-modal-container uk-modal-container--message uk-modal-container--relative-height uk-modal">
            <div class="uk-modal-dialog uk-modal-dialog--flex">
                <button class="uk-modal-close-default uk-close uk-icon" type="button" uk-close=""><svg width="14" height="14" viewBox="0 0 14 14" xmlns="http://www.w3.org/2000/svg" ratio="1"><line fill="none" stroke="#000" stroke-width="1.1" x1="1" y1="1" x2="13" y2="13"></line><line fill="none" stroke="#000" stroke-width="1.1" x1="13" y1="1" x2="1" y2="13"></line></svg></button>

                <div class="uk-modal-body">

                    <div class="c-modal-notification c-join-promotion__modal">
                        <div class="c-card__header">
                            <h2 class="c-card__title">انتخاب کالا از لیست</h2>
                        </div>
                        <div class="c-card__body">
                            <form action="" class="c-ui-form" id="select-search-form">
                                <div class="c-ui-form__row">
                                    <div class="c-ui-form__col c-ui-form__col-4">
                                        <label class="c-ui-form__label" for="search_input">جستجو:</label>
                                        <div class="c-ui-input">
                                            <input type="search" name="query" class="c-ui-input__field c-ui-input__field--order js-form-clearable c-join__input" id="search_input" placeholder="جستجوی کد کالا، کد تنوع و ..." style="width: 400px;">
                                            <button class="uk-icon-button c-join__search-btn uk-icon" uk-icon="icon: search"><svg width="20" height="20" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" ratio="1"> <circle fill="none" stroke="#000" stroke-width="1.1" cx="9" cy="9" r="7"></circle> <path fill="none" stroke="#000" stroke-width="1.1" d="M14,14 L18,18 L14,14 Z"></path></svg></button>
                                        </div>
                                    </div>
                                </div>
                                <div class="c-join__sort-products">
                                    <div>مرتب‌سازی بر اساس:</div>
                                    <div class="c-join__sort-options c-join__filter-container js-search-sort">
                                        <label class="c-join__radio-label">
                                            <input class="c-join__radio" type="radio" name="sort" value="latest" checked="">
                                            <span class="c-join__radio-option">جدیدترین</span>
                                        </label>
                                        <label class="c-join__radio-label">
                                            <input class="c-join__radio" type="radio" name="sort" value="price_low">
                                            <span class="c-join__radio-option">ارزان‌ترین</span>
                                        </label>
                                        <label class="c-join__radio-label">
                                            <input class="c-join__radio" type="radio" name="sort" value="price_high">
                                            <span class="c-join__radio-option">گرانترین</span>
                                        </label>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="js-products-content">

                        </div>
                        <div class="c-card__loading js-modal-loading"></div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</main>
@endsection

@section('script')
    <div id="js-wallet-click-advertising-modal" uk-modal="esc-close: true; bg-close: false;" class="uk-modal-container uk-modal-container--message c-wallet-modal--click-advertising uk-modal">
        <div class="uk-modal-dialog uk-modal-dialog--flex">
            <button class="uk-modal-close-default uk-close uk-icon" type="button" uk-close=""><svg width="14" height="14" viewBox="0 0 14 14" xmlns="http://www.w3.org/2000/svg" ratio="1"><line fill="none" stroke="#000" stroke-width="1.1" x1="1" y1="1" x2="13" y2="13"></line><line fill="none" stroke="#000" stroke-width="1.1" x1="13" y1="1" x2="1" y2="13"></line></svg></button>

            <div class="uk-modal-body">
                <div class="c-wallet-modal c-wallet-modal--refund">
                    <div class="c-wallet-modal c-wallet-modal--charge">
                        <form class="c-wallet-modal__form c-wallet-modal__small-form" id="wallet-advertising-form">
                            <h2 class="c-wallet-modal__title js-advertiser-co">پنل بازاریابی کلیکی
                            </h2>
                            <div class="c-wallet-modal__description uk-margin-remove-bottom">
                                فروشنده عزیز، امکان استفاده از بازاریابی کلیکی از طریق پنلی جداگانه ‌فراهم شده است. همچنین برای استفاده از
                                <br>
                                این امکان باید حساب شما در پنل بازاریابی کلیکی موجودی کافی داشته باشد.
                            </div>
                            <div class="c-wallet-modal__light-text c-ui--mt-20">
                                موجودی فعلی حساب شما در پنل بازاریابی کلیکی
                            </div>
                            <div class="c-wallet-modal__secondary-text c-wallet--mb-9 js-wallet-cpc-credit">
                            </div>
                            <div class="c-wallet-modal__form-row uk-margin-remove">
                                <div class="c-wallet-modal__dark-form-field">
                                    <div class="c-wallet-modal__light-text c-wallet-modal__light-text--bold c-wallet--mb-25">
                                        انتقال موجودی و ورود به پنل
                                    </div>
                                    <label class="c-wallet-modal__input-label" for="wallet-deposit-value">موجودی کیف پول شما در پنل {{ $fa_store_name }} (ریال)</label>
                                    <input id="wallet-deposit-value" class="c-wallet-modal__input-field js-wallet-credit" disabled="" type="text" name="wallet-deposit-value" value="">

                                    <div class="c-wallet-modal__dark-text c-ui--mt-10 js-empty-wallet-credit uk-hidden">
                                        با توجه به اینکه کیف پول شما در پنل {{ $fa_store_name }} فاقد موجودی است امکان انتقال موجودی به پنل بازاریابی کلیکی برای شما امکان پذیر نیست
                                    </div>

                                    <div class="js-wallet-has-credit uk-hidden">
                                        <label class="c-wallet-modal__input-label c-wallet--mt-15" for="wallet-charge-click-advertising">
                                            مبلغ مورد نظر برای انتقال به پنل بازاریابی کلیکی (ریال)
                                            <span data-tooltip-type="normal" data-tooltip-position="br" data-tooltip-has-before-element="" data-icon="guide-new" class="o-font-size-16 o-text-color-n-700 o-spacing-m-r-1" style="vertical-align: bottom;">
                                    <span data-tooltip-body="" class="o-font-size-12" style="width: 250px">
                                        درحال حاضر مبلغ محاسبه شده برای شما با احتساب ارزش افزوده می‌باشد. ولی در آینده ارزش افزوده به مبلغ درخواست‌های جدید شما اضافه خواهد شد.
                                    </span>
                                </span>
                                        </label>
                                        <input id="wallet-charge-click-advertising" class="o-spacing-m-t-1 c-wallet-modal__input-field js-wallet-input js-charge-ad-input" name="wallet-charge-click-advertising" type="text" data-deposit="" data-type="refund" placeholder="مبلغ مورد نظر را به عدد وارد کنید...">
                                        <span class="c-wallet-modal__input-message js-wallet-input-message">مبلغ وارد شده، بیش از موجودی کیف پول شماست.</span>
                                    </div>

                                    <button class="c-wallet-modal__button c-wallet-modal__button--secondary
                                        js-wallet-modal-submit js-charge-click-advertising-panel" data-type="twoStepRedirectToAdPanel" type="button" disabled="">
                                        تایید انتقال و ورود به پنل
                                    </button>
                                    <div class="c-wallet-modal__light-text js-warning-cpc-message uk-text-bold c-ui--mt-10">
                                        بعد از تایید انتقال مبلغ قابل برگشت به کیف پول نیست
                                    </div>
                                </div>
                                <div class="c-wallet-modal__dark-form-field c-ui--mr-10">
                                    <div class="c-wallet-modal__light-text c-wallet-modal__light-text--bold c-wallet--mb-25">
                                        ورود به پنل بدون انتقال موجودی
                                    </div>
                                    <div class="c-wallet-modal__light-text c-wallet-modal__light-text--medium js-check-cpc-panel">
                                        چنانچه موجودی حساب شما در پنل بازاریابی کلیکی کافی است و یا فقط قصد بررسی این پنل را دارید می‌توانید بدون انتقال موجودی به آن مراجعه کنید.
                                    </div>
                                    <button class="c-wallet-modal__button c-wallet-modal__button--large-active" type="button">
                                        <a href="/cpc/thirdParties/redirect/">
                                            ورود به پنل بدون انتقال مبلغ
                                        </a>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="c-content-loader">
                    <div class="c-content-loader__logo"></div>
                    <div class="c-content-loader__spinner"></div>
                </div>

            </div>
        </div>
    </div>

    <div id="js-wallet-charge-advertising-success-modal" uk-modal="esc-close: true; bg-close: false;" class="uk-modal-container uk-modal-container--message c-wallet-modal--click-advertising uk-modal">
        <div class="uk-modal-dialog uk-modal-dialog--flex">
            <button class="uk-modal-close-default uk-close uk-icon" type="button" uk-close=""><svg width="14" height="14" viewBox="0 0 14 14" xmlns="http://www.w3.org/2000/svg" ratio="1"><line fill="none" stroke="#000" stroke-width="1.1" x1="1" y1="1" x2="13" y2="13"></line><line fill="none" stroke="#000" stroke-width="1.1" x1="13" y1="1" x2="1" y2="13"></line></svg></button>

            <div class="uk-modal-body">
                <div class="c-wallet-modal c-wallet-modal--refund">
                    <div class="c-wallet-modal c-wallet-modal--charge">
                        <div class="c-wallet-modal__form c-wallet-modal__small-form uk-flex uk-flex-column uk-flex-middle">
                            <img src="https://seller.digikala.com/static/files/e107b672.svg">
                            <div class="c-wallet__payment-status-title c-wallet--mt-40">
                                انتقال مبلغ به حساب پنل بازاریابی کلیکی با موفقیت انجام شد.
                            </div>
                            <div class="c-wallet__payment-status-sub-title uk-flex uk-flex-center">مبلغ مورد نظر شما با شماره پیگیری
                                <span class="c-wallet__payment-status-sub-title-traking-num js-trackingCode"></span>
                                به حساب پنل بازاریابی کلیکی منتقل شد.
                            </div>
                            <div class="c-wallet--mt-35 uk-flex uk-flex-center uk-margin-remove-bottom">
                                <div class="c-wallet--small-item">
                                    <label class="c-wallet-modal__input-label" for="wallet-advertising-deposit-value">انتقال یافته از کیف پول {{ $fa_store_name }} (ریال)</label>
                                    <input class="c-wallet-modal__input-field c-wallet-modal__input-field--small js-cpc-charged" name="wallet-advertising-deposit-value" type="text" value="" disabled="">
                                </div>
                                <div class="c-wallet--small-item c-ui--mr-10">
                                    <label class="c-wallet-modal__input-label" for="wallet-advertising-deposit-value">موجودی حساب پنل بازاریابی کلیکی (ریال)</label>
                                    <input class="c-wallet-modal__input-field c-wallet-modal__input-field--small js-cpc-current-credit" name="wallet-advertising-deposit-value" type="text" value="" disabled="">
                                </div>
                            </div>

                            <div class="c-wallet-modal__progress c-wallet--mt-80">
                                <span class="c-wallet-modal__progress--passed js-progress-passed"></span>
                            </div>

                            <div class="c-wallet-modal__light-text c-wallet-modal__light-text--medium c-ui--mt-15 uk-flex">
                                انتقال به پنل بازاریابی کلیکی تا&nbsp;
                                <div class="c-wallet-modal__light-text--secondary">
                    <span class="js-time-to-redirect">
                        21
                    </span>
                                    ثانیه دیگر
                                </div>
                            </div>

                            <button class="c-wallet-modal__button c-wallet-modal__button--secondary c-ui--mt-30">
                                <a href="" class="js-redirect-to-ad-panel">
                                    تایید انتقال و ورود به پنل
                                </a>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="js-wallet-charge-advertising-failed-modal" uk-modal="esc-close: true; bg-close: false;" class="uk-modal-container uk-modal-container--message c-wallet-modal--click-advertising uk-modal">
        <div class="uk-modal-dialog uk-modal-dialog--flex">
            <button class="uk-modal-close-default uk-close uk-icon" type="button" uk-close=""><svg width="14" height="14" viewBox="0 0 14 14" xmlns="http://www.w3.org/2000/svg" ratio="1"><line fill="none" stroke="#000" stroke-width="1.1" x1="1" y1="1" x2="13" y2="13"></line><line fill="none" stroke="#000" stroke-width="1.1" x1="13" y1="1" x2="1" y2="13"></line></svg></button>

            <div class="uk-modal-body">
                <div class="c-wallet-modal c-wallet-modal--refund">
                    <div class="c-wallet-modal c-wallet-modal--charge">
                        <div class="c-wallet-modal__form c-wallet-modal__small-form uk-flex uk-flex-column uk-flex-middle">
                            <img src="https://seller.digikala.com/static/files/a2fa83da.svg">
                            <div class="c-wallet__payment-status-title c-wallet--mt-35">
                                انتقال مبلغ به حساب پنل بازاریابی کلیکی انجام نشد.
                            </div>
                            <div class="c-wallet__payment-status-sub-title">تراکنش مورد نظر شما بنا به دلایلی انجام نشده و با خطا مواجه شده است.
                            </div>
                            <div class="c-wallet--mt-50 uk-flex uk-flex-center">
                                <button class="c-wallet__payment-status-btn c-wallet__payment-status-btn-redirect js-retry-charge-ad-panel" data-type="twoStepRedirectToAdPanel">
                                    تلاش مجدد برای انتقال
                                </button>
                                <button class="c-wallet__payment-status-btn c-wallet__payment-status-btn-outline c-ui--mr-15">
                                    <a href="/cpc/thirdParties/redirect/">
                                        ورود به پنل بدون انتقال مبلغ
                                    </a>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="non-original-warning" uk-modal="esc-close: true; bg-close: true;" class="uk-modal-container uk-modal-container--message uk-modal">
        <div class="uk-modal-dialog uk-modal-dialog--flex">
            <button class="uk-modal-close-default uk-close uk-icon" type="button" uk-close=""><svg width="14" height="14" viewBox="0 0 14 14" xmlns="http://www.w3.org/2000/svg" ratio="1"><line fill="none" stroke="#000" stroke-width="1.1" x1="1" y1="1" x2="13" y2="13"></line><line fill="none" stroke="#000" stroke-width="1.1" x1="13" y1="1" x2="1" y2="13"></line></svg></button>

            <div class="uk-modal-body">
                <div class="c-modal-notification">
                    <div class="c-modal-notification__content c-modal-notification__content--limited">
                        <div class="c-modal-notification__img">
                            <img src="https://seller.digikala.com/static/files/422f7e40.svg" alt="">
                        </div>

                        <h2 class="c-modal-notification__header">توجه!</h2>
                        <p class="c-modal-notification__text c-modal-notification__text--center">
                            همانطور که مطلع هستید <em>فروش کالای غیر اصل به اسم کالای اصل در {{ $fa_store_name }} اکیدا ممنوع است</em>. از شما تقاضا داریم نهایت دقت را در رعایت این قانون مبذول فرمایید.<br>
                            در صورت فروش کالای غیر اصل، فروشنده موظف به <em>پرداخت جریمه‌ای معادل با 10 برابر کل درآمد حاصل از فروش کالای غیر اصل خواهد بود</em> و {{ $fa_store_name }} مجاز به فسخ بلافاصله قرارداد همکاری با فروشنده می‌باشد.<br>
                            امکان فروش کالای غیراصل فقط با شرط استفاده از <em>"نشان کالای غیراصل"</em> هنگام درج کالا وجود دارد. برای اطلاعات بیشتر مقاله <a target="_blank" href="https://selleracademy.digikala.com/%D9%81%D8%B1%D9%88%D8%B4-%DA%A9%D8%A7%D9%84%D8%A7%DB%8C-%D8%BA%DB%8C%D8%B1%D8%A7%D8%B5%D9%84-%D8%AF%D8%B1-%D8%AF%DB%8C%D8%AC%DB%8C%E2%80%8C%DA%A9%D8%A7%D9%84%D8%A7/">"شرایط فروش کالاهای های غیراصل در {{ $fa_store_name }}"</a> را مطالعه کنید.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div uk-modal="esc-close: true; bg-close: true;" class="uk-modal-container uk-modal-container--message js-common-modal-notification uk-modal">
        <div class="uk-modal-dialog uk-modal-dialog--flex">
            <button class="uk-modal-close-default uk-close uk-icon" type="button" uk-close=""><svg width="14" height="14" viewBox="0 0 14 14" xmlns="http://www.w3.org/2000/svg" ratio="1"><line fill="none" stroke="#000" stroke-width="1.1" x1="1" y1="1" x2="13" y2="13"></line><line fill="none" stroke="#000" stroke-width="1.1" x1="13" y1="1" x2="1" y2="13"></line></svg></button>

            <div class="uk-modal-body">
                <div class="c-modal-notification">
                    <div class="c-modal-notification__content c-modal-notification__content--limited">



                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="national-id-restriction-modal" uk-modal="esc-close: false; bg-close: false;" class="uk-modal-container uk-modal" data-id="" data-status="hoda_none">
        <div class="uk-modal-dialog uk-modal-dialog--form c-interactive-status--mw-850">

            <div class="uk-modal-body uk-modal-body--align-normal">
                <div class="uk-flex uk-flex-center uk-flex-middle uk-flex-column">
                    <img class="uk-margin-small-top" src="https://seller.digikala.com/static/files/a2fa83da.svg">
                    <div class="o-spacing-m-t-4 c-interactive-status__modal-title">احراز هویت انجام نشده است</div>
                    <div class="o-spacing-m-t-4 uk-text-center o-text-color-n-600">
                        فروشنده گرامی،
                        <br>
                        متاسفانه به علت عدم احراز هویت شما در ۷ روز گذشته، دسترسی شما به پنل مسدود شده است.
                        <br>
                        لطفا در صورتی که سفارشات ارسال نشده در پنل دارید، نسبت به ارسال آنها در اسرع وقت اقدام فرمایید.
                    </div>
                    <div class="o-spacing-m-t-4 c-interactive-status__modal-des">
                        جهت دسترسی مجدد به پنل، لطفا مراحل احراز هویت را تکمیل کنید.
                    </div>
                    <div class="o-spacing-m-t-4 c-interactive-status__modal-warning js-second-restriction-notif uk-hidden">
                        پس از تکمیل و تایید احراز هویت در سامانه، دسترسی شما به پنل به صورت خودکار ایجاد شده و شما
                        <br>
                        می‌توانید کالاهای خود را مجدداً فعال کنید.
                    </div>
                    <a href="https://selleracademy.digikala.com/%d8%a7%d8%ad%d8%b1%d8%a7%d8%b2-%d9%87%d9%88%db%8c%d8%aa-%d9%81%d8%b1%d9%88%d8%b4%d9%86%d8%af%da%af%d8%a7%d9%86-%d8%ad%d9%82%db%8c%d9%82%db%8c-%d8%aa%d9%88%d8%b3%d8%b7-%d8%a7%d8%af%d8%a7%d8%b1%d9%87/" class="o-text-color-seller-primary o-spacing-m-t-4 o-font-size-14">
                        آموزش نحوه احراز هویت فروشندگان حقیقی توسط سازمان ثبت احوال
                    </a>
                    <div class="uk-flex o-spacing-m-t-6">
                        <a href="" target="_blank" class="c-interactive-status__modal-btn c-interactive-status__modal-btn--primery">
                            احراز هویت حساب کاربری
                        </a>
                        <div class="c-interactive-status__modal-btn c-interactive-status__modal-btn--gray o-spacing-m-r-3 js-close-restriction-modal">
                            بعداً انجام می‌دهم
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="persianDateInstance-779" class="datepicker-container pwt-hide" style="left: 636px; top: 341px;"><div id="plotId" class="datepicker-plot-area  datepicker-state-no-meridian  datepicker-state-no-second datepicker-persian">
            <div data-navigator="" class="datepicker-navigator">
                <div class="pwt-btn pwt-btn-next">&lt;</div>
                <div class="pwt-btn pwt-btn-switch">۱۳۹۹ اسفند</div>
                <div class="pwt-btn pwt-btn-prev">&gt;</div>
            </div>
            <div class="datepicker-grid-view">
                <div class="datepicker-day-view">
                    <div class="month-grid-box">
                        <div class="header">
                            <div class="title"></div>
                            <div class="header-row">
                                <div class="header-row-cell">ش</div>
                                <div class="header-row-cell">ی</div>
                                <div class="header-row-cell">د</div>
                                <div class="header-row-cell">س</div>
                                <div class="header-row-cell">چ</div>
                                <div class="header-row-cell">پ</div>
                                <div class="header-row-cell">ج</div>
                            </div>
                        </div>
                        <table cellspacing="0" class="table-days">
                            <tbody>

                            <tr>
                                <td data-date="1399,11,25" data-unix="1613161800000" class="disabled">
                                    <span class="other-month">۲۵</span>
                                </td>

                                <td data-date="1399,11,26" data-unix="1613248200000" class="disabled">
                                    <span class="other-month">۲۶</span>
                                </td>

                                <td data-date="1399,11,27" data-unix="1613334600000" class="disabled">
                                    <span class="other-month">۲۷</span>
                                </td>

                                <td data-date="1399,11,28" data-unix="1613421000000" class="disabled">
                                    <span class="other-month">۲۸</span>
                                </td>

                                <td data-date="1399,11,29" data-unix="1613507400000" class="disabled">
                                    <span class="other-month">۲۹</span>
                                </td>

                                <td data-date="1399,11,30" data-unix="1613593800000" class="disabled">
                                    <span class="other-month">۳۰</span>
                                </td>

                                <td data-date="1399,12,1" data-unix="1613751924725" class="disabled">
                                    <span class="">۱</span>
                                </td>

                            </tr>

                            <tr>
                                <td data-date="1399,12,2" data-unix="1613838324725" class="disabled">
                                    <span class="">۲</span>
                                </td>

                                <td data-date="1399,12,3" data-unix="1613924724725" class="disabled">
                                    <span class="">۳</span>
                                </td>

                                <td data-date="1399,12,4" data-unix="1614011124725" class="disabled">
                                    <span class="">۴</span>
                                </td>

                                <td data-date="1399,12,5" data-unix="1614097524725" class="disabled">
                                    <span class="">۵</span>
                                </td>

                                <td data-date="1399,12,6" data-unix="1614183924725" class="disabled">
                                    <span class="">۶</span>
                                </td>

                                <td data-date="1399,12,7" data-unix="1614270324725" class="disabled">
                                    <span class="">۷</span>
                                </td>

                                <td data-date="1399,12,8" data-unix="1614356724725" class="disabled">
                                    <span class="">۸</span>
                                </td>

                            </tr>

                            <tr>
                                <td data-date="1399,12,9" data-unix="1614443124725" class="disabled">
                                    <span class="">۹</span>
                                </td>

                                <td data-date="1399,12,10" data-unix="1614529524725" class="disabled">
                                    <span class="">۱۰</span>
                                </td>

                                <td data-date="1399,12,11" data-unix="1614615924725" class="disabled">
                                    <span class="">۱۱</span>
                                </td>

                                <td data-date="1399,12,12" data-unix="1614702324725" class="disabled">
                                    <span class="">۱۲</span>
                                </td>

                                <td data-date="1399,12,13" data-unix="1614788724725" class="disabled">
                                    <span class="">۱۳</span>
                                </td>

                                <td data-date="1399,12,14" data-unix="1614875124725" class="disabled">
                                    <span class="">۱۴</span>
                                </td>

                                <td data-date="1399,12,15" data-unix="1614961524725" class="disabled">
                                    <span class="">۱۵</span>
                                </td>

                            </tr>

                            <tr>
                                <td data-date="1399,12,16" data-unix="1615047924725" class="disabled">
                                    <span class="">۱۶</span>
                                </td>

                                <td data-date="1399,12,17" data-unix="1615134324725" class="selected today">
                                    <span class="">۱۷</span>
                                </td>

                                <td data-date="1399,12,18" data-unix="1615220724725">
                                    <span class="">۱۸</span>
                                </td>

                                <td data-date="1399,12,19" data-unix="1615307124725">
                                    <span class="">۱۹</span>
                                </td>

                                <td data-date="1399,12,20" data-unix="1615393524725">
                                    <span class="">۲۰</span>
                                </td>

                                <td data-date="1399,12,21" data-unix="1615479924725">
                                    <span class="">۲۱</span>
                                </td>

                                <td data-date="1399,12,22" data-unix="1615566324725">
                                    <span class="">۲۲</span>
                                </td>

                            </tr>

                            <tr>
                                <td data-date="1399,12,23" data-unix="1615652724725">
                                    <span class="">۲۳</span>
                                </td>

                                <td data-date="1399,12,24" data-unix="1615739124725">
                                    <span class="">۲۴</span>
                                </td>

                                <td data-date="1399,12,25" data-unix="1615825524725">
                                    <span class="">۲۵</span>
                                </td>

                                <td data-date="1399,12,26" data-unix="1615911924725">
                                    <span class="">۲۶</span>
                                </td>

                                <td data-date="1399,12,27" data-unix="1615998324725">
                                    <span class="">۲۷</span>
                                </td>

                                <td data-date="1399,12,28" data-unix="1616084724725">
                                    <span class="">۲۸</span>
                                </td>

                                <td data-date="1399,12,29" data-unix="1616171124725">
                                    <span class="">۲۹</span>
                                </td>

                            </tr>

                            <tr>
                                <td data-date="1399,12,30" data-unix="1616257524725">
                                    <span class="">۳۰</span>
                                </td>

                                <td data-date="1400,1,1" data-unix="1616358599000">
                                    <span class="other-month">۱</span>
                                </td>

                                <td data-date="1400,1,3" data-unix="1616527799000">
                                    <span class="other-month">۳</span>
                                </td>

                                <td data-date="1400,1,4" data-unix="1616614199000">
                                    <span class="other-month">۴</span>
                                </td>

                                <td data-date="1400,1,5" data-unix="1616700599000">
                                    <span class="other-month">۵</span>
                                </td>

                                <td data-date="1400,1,6" data-unix="1616786999000">
                                    <span class="other-month">۶</span>
                                </td>

                                <td data-date="1400,1,7" data-unix="1616873399000">
                                    <span class="other-month">۷</span>
                                </td>

                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>



            </div>
            <div class="datepicker-time-view">
                <div class="hour time-segment" data-time-key="hour">
                    <div class="up-btn" data-time-key="hour">▲</div>
                    <input value="۱۹" type="text" placeholder="hour" class="hour-input">
                    <div class="down-btn" data-time-key="hour">▼</div>
                </div>
                <div class="divider">
                    <span>:</span>
                </div>
                <div class="minute time-segment" data-time-key="minute">
                    <div class="up-btn" data-time-key="minute">▲</div>
                    <input disabled="" value="۵۵" type="text" placeholder="minute" class="minute-input">
                    <div class="down-btn" data-time-key="minute">▼</div>
                </div>
                <div class="divider second-divider">
                    <span>:</span>
                </div>
            </div>

            <div class="toolbox">
                <div class="pwt-btn-submit">تایید</div>
            </div>
        </div></div>

    <div id="persianDateInstance-794" class="datepicker-container pwt-hide" style="left: 421px; top: 341px;"><div id="plotId" class="datepicker-plot-area  datepicker-state-no-meridian  datepicker-state-no-second datepicker-persian">
            <div data-navigator="" class="datepicker-navigator">
                <div class="pwt-btn pwt-btn-next">&lt;</div>
                <div class="pwt-btn pwt-btn-switch">۱۳۹۹ اسفند</div>
                <div class="pwt-btn pwt-btn-prev">&gt;</div>
            </div>
            <div class="datepicker-grid-view">
                <div class="datepicker-day-view">
                    <div class="month-grid-box">
                        <div class="header">
                            <div class="title"></div>
                            <div class="header-row">
                                <div class="header-row-cell">ش</div>
                                <div class="header-row-cell">ی</div>
                                <div class="header-row-cell">د</div>
                                <div class="header-row-cell">س</div>
                                <div class="header-row-cell">چ</div>
                                <div class="header-row-cell">پ</div>
                                <div class="header-row-cell">ج</div>
                            </div>
                        </div>
                        <table cellspacing="0" class="table-days">
                            <tbody>

                            <tr>
                                <td data-date="1399,11,25" data-unix="1613161800000" class="disabled">
                                    <span class="other-month">۲۵</span>
                                </td>

                                <td data-date="1399,11,26" data-unix="1613248200000" class="disabled">
                                    <span class="other-month">۲۶</span>
                                </td>

                                <td data-date="1399,11,27" data-unix="1613334600000" class="disabled">
                                    <span class="other-month">۲۷</span>
                                </td>

                                <td data-date="1399,11,28" data-unix="1613421000000" class="disabled">
                                    <span class="other-month">۲۸</span>
                                </td>

                                <td data-date="1399,11,29" data-unix="1613507400000" class="disabled">
                                    <span class="other-month">۲۹</span>
                                </td>

                                <td data-date="1399,11,30" data-unix="1613593800000" class="disabled">
                                    <span class="other-month">۳۰</span>
                                </td>

                                <td data-date="1399,12,1" data-unix="1613751924756" class="disabled">
                                    <span class="">۱</span>
                                </td>

                            </tr>

                            <tr>
                                <td data-date="1399,12,2" data-unix="1613838324756" class="disabled">
                                    <span class="">۲</span>
                                </td>

                                <td data-date="1399,12,3" data-unix="1613924724756" class="disabled">
                                    <span class="">۳</span>
                                </td>

                                <td data-date="1399,12,4" data-unix="1614011124756" class="disabled">
                                    <span class="">۴</span>
                                </td>

                                <td data-date="1399,12,5" data-unix="1614097524756" class="disabled">
                                    <span class="">۵</span>
                                </td>

                                <td data-date="1399,12,6" data-unix="1614183924756" class="disabled">
                                    <span class="">۶</span>
                                </td>

                                <td data-date="1399,12,7" data-unix="1614270324756" class="disabled">
                                    <span class="">۷</span>
                                </td>

                                <td data-date="1399,12,8" data-unix="1614356724756" class="disabled">
                                    <span class="">۸</span>
                                </td>

                            </tr>

                            <tr>
                                <td data-date="1399,12,9" data-unix="1614443124756" class="disabled">
                                    <span class="">۹</span>
                                </td>

                                <td data-date="1399,12,10" data-unix="1614529524756" class="disabled">
                                    <span class="">۱۰</span>
                                </td>

                                <td data-date="1399,12,11" data-unix="1614615924756" class="disabled">
                                    <span class="">۱۱</span>
                                </td>

                                <td data-date="1399,12,12" data-unix="1614702324756" class="disabled">
                                    <span class="">۱۲</span>
                                </td>

                                <td data-date="1399,12,13" data-unix="1614788724756" class="disabled">
                                    <span class="">۱۳</span>
                                </td>

                                <td data-date="1399,12,14" data-unix="1614875124756" class="disabled">
                                    <span class="">۱۴</span>
                                </td>

                                <td data-date="1399,12,15" data-unix="1614961524756" class="disabled">
                                    <span class="">۱۵</span>
                                </td>

                            </tr>

                            <tr>
                                <td data-date="1399,12,16" data-unix="1615047924756" class="disabled">
                                    <span class="">۱۶</span>
                                </td>

                                <td data-date="1399,12,17" data-unix="1615134324756" class="selected today">
                                    <span class="">۱۷</span>
                                </td>

                                <td data-date="1399,12,18" data-unix="1615220724756">
                                    <span class="">۱۸</span>
                                </td>

                                <td data-date="1399,12,19" data-unix="1615307124756">
                                    <span class="">۱۹</span>
                                </td>

                                <td data-date="1399,12,20" data-unix="1615393524756">
                                    <span class="">۲۰</span>
                                </td>

                                <td data-date="1399,12,21" data-unix="1615479924756">
                                    <span class="">۲۱</span>
                                </td>

                                <td data-date="1399,12,22" data-unix="1615566324756">
                                    <span class="">۲۲</span>
                                </td>

                            </tr>

                            <tr>
                                <td data-date="1399,12,23" data-unix="1615652724756">
                                    <span class="">۲۳</span>
                                </td>

                                <td data-date="1399,12,24" data-unix="1615739124756">
                                    <span class="">۲۴</span>
                                </td>

                                <td data-date="1399,12,25" data-unix="1615825524756">
                                    <span class="">۲۵</span>
                                </td>

                                <td data-date="1399,12,26" data-unix="1615911924756">
                                    <span class="">۲۶</span>
                                </td>

                                <td data-date="1399,12,27" data-unix="1615998324756">
                                    <span class="">۲۷</span>
                                </td>

                                <td data-date="1399,12,28" data-unix="1616084724756">
                                    <span class="">۲۸</span>
                                </td>

                                <td data-date="1399,12,29" data-unix="1616171124756">
                                    <span class="">۲۹</span>
                                </td>

                            </tr>

                            <tr>
                                <td data-date="1399,12,30" data-unix="1616257524756">
                                    <span class="">۳۰</span>
                                </td>

                                <td data-date="1400,1,1" data-unix="1616358599000">
                                    <span class="other-month">۱</span>
                                </td>

                                <td data-date="1400,1,3" data-unix="1616527799000">
                                    <span class="other-month">۳</span>
                                </td>

                                <td data-date="1400,1,4" data-unix="1616614199000">
                                    <span class="other-month">۴</span>
                                </td>

                                <td data-date="1400,1,5" data-unix="1616700599000">
                                    <span class="other-month">۵</span>
                                </td>

                                <td data-date="1400,1,6" data-unix="1616786999000">
                                    <span class="other-month">۶</span>
                                </td>

                                <td data-date="1400,1,7" data-unix="1616873399000">
                                    <span class="other-month">۷</span>
                                </td>

                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>



            </div>
            <div class="datepicker-time-view">
                <div class="hour time-segment" data-time-key="hour">
                    <div class="up-btn" data-time-key="hour">▲</div>
                    <input value="۱۹" type="text" placeholder="hour" class="hour-input">
                    <div class="down-btn" data-time-key="hour">▼</div>
                </div>
                <div class="divider">
                    <span>:</span>
                </div>
                <div class="minute time-segment" data-time-key="minute">
                    <div class="up-btn" data-time-key="minute">▲</div>
                    <input disabled="" value="۵۵" type="text" placeholder="minute" class="minute-input">
                    <div class="down-btn" data-time-key="minute">▼</div>
                </div>
                <div class="divider second-divider">
                    <span>:</span>
                </div>
            </div>

            <div class="toolbox">
                <div class="pwt-btn-submit">تایید</div>
            </div>
        </div>
    </div>

<script>
// // اضافه کردن توکن به درخواست های ایجکس
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

// تغییر پدینگ فیلد نامک
var buttonWidth = $('#button-urls').width() + 20;
$(".url-inputs").css({
    'padding-left': buttonWidth,
    'padding-top' : '2px',
});
</script>
@endsection

