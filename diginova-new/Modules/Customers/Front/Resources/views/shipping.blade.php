@php
  $store_email = \Modules\Staff\Setting\Models\Setting::where('name', 'store_email')->first()->value;
  $store_phone = \Modules\Staff\Setting\Models\Setting::where('name', 'store_phone')->first()->value;
@endphp

<?php $cons_count = 0; ?>
@foreach($weights as $weight)
  @foreach ($first_carts as $item)
    @if ($item->product_variant()->first()->product->weight()->first()->id == $weight->id)
      <?php $cons_count++; ?>
      @break;
    @endif
  @endforeach
@endforeach

<!DOCTYPE html>
<html class="" style="" dir="rtl">
<head>
  <title>آدرس و زمان ارسال | {{ $fa_store_name }}</title>
  <script>
    var module_hash_id_storage = 1;
    var module_no_replace_update_command_status = 1;
    var module_adding_new_days_to_incredible_and_plus = 1;
    var module_new_rrp_change_rule_for_incredible_offers = 1;
    var module_tapsell_pdp = 1;
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
    var module_marketplace_new_invoice_design = 1;
    var module_marketplace_add_work_day_digikala = 1;
    var module_marketplace_warehouse_postal_code = 1;
    var module_marketplace_seller_api_new_design = 1;
    var module_marketplace_show_warehouse_address_map = 1;
    var module_marketplace_reporting_and_insights_top_deactivated = 1;
    var module_marketplace_village_seller_badge = 1;
    var module_marketplace_add_work_day = 1;
    var module_ds_return_order = 1;
    var module_breaking_payment = 1;
    var module_orders_full_log = 1;
    var module_cancel_generate_refund_transaction_for_wrong_order = 1;
    var module_available_ts_for_non_plus_users = 1;
    var module_marketplace_promotion_new_features = 1;
    var module_redesign_dk_typographies = 1;
    var module_app_break_payment = 1;
    var module_admin_panel_notification_log = 1;
    var module_only_fresh_filter = 1;
    var module_disable_some_sms = 1;
    var module_dk_cpc_new_placement_in_pdp = 1;
    var module_plus_subscription_nps = 1;
    var module_digiclub_history_improvement = 1;
    var module_nps_post = 1;
    var module_dk_banner_view_impression_event = 1;
    var module_ds_seller_satisfaction_graph_desktop = 1;
    var module_voucher_revamp = 1;
    var module_main_category_dynamic_carousels = 1;
    var module_plus_partnership_filimo = 1;
    var module_plus_partnership = 1;
    var module_dk_end_of_referral_time = 1;
    var module_new_luckydraw_season_demo = 1;
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
    var module_digistyle_special_event = 1;
    var module_digistyle_voucher_spinner = 1;
    var module_cart_sampling_gift = 1;
    var module_ds_favorite_brands = 1;
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
    var module_ab_test_plp_rating = 1;
    var module_admin_warranty_insurance = 1;
    var module_new_profile_orders = 1;
    var module_new_profile_sidebar = 1;
    var module_delete_comment = 1;
    var module_new_market_price_rules = 1;
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
    var module_sfl_separation = 1;
    var module_esi_in_mini_header = 1;
    var module_banner_url_check = 1;
    var module_new_mobile_header = 1;
    var module_dk_mobile_menu_revision = 1;
    var module_voucher_fraud_detection = 1;
    var module_marketplace_dk_pickup_shipment = 1;
    var module_marketplace_create_package_shipment = 1;
    var module_shipment_effect_create_package = 1;
    var module_recaptcha_contact_us = 1;
    var module_data_layer = 1;
    var module_data_layer_carousels = 1;
    var module_data_layer_phase2 = 1;
    var module_data_layer_my_landing = 1;
    var module_checkout_action_button_replacement = 1;
    var module_new_comment = 1;
    var module_new_profile_orders_mobile = 1;
    var module_new_price_chart_header = 1;
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
    var module_stop_sending_email_sms_to_sellers = 1;
    var module_nps_ship_by_seller = 1;
    var module_new_login = 1;
    var module_cpo_import_excel = 1;
    var module_refund_end_to_end = 1;
    var module_ship_by_seller_ovl = 1;
    var module_collective_promotions_module = 1;
    var module_selection_pricing = 1;
    var module_dynamic_shipping_cost = 1;
    var module_sbs_failed_delivery = 1;
    var module_jet_delivery = 1;
    var module_amazing_carousel_show_all = 1;
    var module_marketplace_seller_data = 1;
    var module_new_economic_profile = 1;
    var module_jet_delivery_filter = 1;
    var module_new_burger_menu = 1;
    var module_ds_home_rearrange = 1;
    var module_new_cmp_category = 1;
    var module_auto_title_suggestion = 1;
    var module_dk_rebranding = 1;
    var module_rebrand_border_radius = 1;
    var module_variant_restrictions = 1;
    var module_new_question_gallery = 1;
    var module_add_imei_to_packages = 1;
    var module_cart_swiper_ab_test = 1;
    var module_cpo_excel_import = 1;
    var module_ml_profile_ab_test = 1;
    var module_sbs_delivery_send_delivered_sms = 1;
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
    var module_iban = 1;
    var module_marketplace_product_config_sortable_product_id = 1;
    var module_marketplace_profile_commitment_download_link = 1;
    var module_pause_brand_campaign_with_out_of_stock_dkp = 1;
    var module_sbs_carousels = 1;
    var module_content_config = 1;
    var module_sbs_improvement = 1;
    var module_data_layer_ds = 1;
    var module_dimensions_required_cf_view = 1;
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
    var module_best_selling_data_layer = 1;
    var module_digipay_touchpoints = 1;
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
    var module_dk_company_national_number_equal_economic = 1;
    var module_video_bulk = 1;
    var module_dpo_update_price = 1;
    var module_fulfillment_dpo_rts_validation = 1;
    var module_seller_first_party_updater = 1;
    var module_admin_panel_payment_limitation = 1;
    var module_new_customer_floating_box = 1;
    var module_check_having_wallet_before_set_wallet_prefer = 1;
    var module_lead_time_postpone = 1;
    var module_plus_free_shipment_expansion = 1;
    var module_dynamic_shipping_cost_phase_2 = 1;
    var module_new_desktop_time_table = 1;
    var module_pdp_plp_special_amazing = 1;
    var module_ab_app_incredible_demo = 1;
    var module_fresh_instant_plus_cash_back = 1;
    var module_find_gift_activation_panel = 1;
    var module_magnet_comment = 1;
    var module_multiple_choice_reason_of_call = 1;
    var module_similar_brand = 1;
    var module_plp_mobile_fidibo_banner = 1;
    var module_custom_payment_plus = 1;
    var module_asserting_pricing_rules_in_po = 1;
    var module_search_product_suggestions = 1;
    var module_ds_new_footer = 1;
    var module_chatbot = 1;
    var module_ds_refund_modals = 1;
    var module_ds_seo_home_page = 1;
    var module_dk_my_landing_carousel = 1;
    var module_dk_product_badge = 1;
    var module_ds_new_home_desktop = 1;
    var module_payment_voucher_gift_separation = 1;
    var module_cpc_pdp_placements = 1;
    var module_fulfilemnt_po_international = 1;
    var module_dk_search_boxes = 1;
    var module_notify_seller_shipment_cancel = 1;
    var module_dk_new_footer = 1;
    var module_dc_polygon_new = 1;
    var module_ab_new_buy_again = 1;
    var module_fiscal_invoice = 1;
    var module_supplier_duplicate_sheba = 1;
    var module_dk_app_banner_ga = 1;
    var module_consignment_checker_fix = 1;
    var module_change_qr_code_generator = 1;
    var module_international_po_warranty = 1;
    var module_market_price_validation_for_not_changeable_types = 1;
    var module_ds_cancel_order = 1;
    var module_dk_mobile_menu_magnet = 1;
    var module_banner_data_layer_ds = 1;
    var module_iranian_brands_category_ds_data_layer = 1;
    var module_wish_list_data_layer = 1;
    var module_use_new_attribute_structure = 1;
    var module_marketplace_order_package_creation = 1;
    var module_JIT_fc_update = 1;
    var module_jet_delivery_dynamic_stock = 1;
    var module_plus_invoice_discount = 1;
    var module_seller_holiday_setting = 1;
    var module_marketplace_add_new_cut_off = 1;
    var module_dk_mobile_magnet_header = 1;
    var module_ds_new_plp_desktop = 1;
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
  </script>
  <script type="text/javascript">
    window.sntrackerActivation = true;
  </script>
  <!-- Data Layer -->
  <script>
    try {
      var dataLayer = [];
      window.dataLayerData = [{
        "event": "eec.checkout",
        "ecommerce": {"checkout": {"actionField": {"step": 2}}}
      }, {
        "event": "eec.checkoutOption",
        "ecommerce": {"checkout_option": {"actionField": {"step": 2, "option": "Customer"}}}
      }];

      if (Object.prototype.toString.call(dataLayerData) === '[object Object]') {
        dataLayer.push(dataLayerData);
      } else {
        dataLayerData.forEach(function (eventItem) {
          dataLayer.push(eventItem);
        });
      }

      delete window.dataLayerData;
    } catch (e) {
      window.Sentry && window.Sentry.captureException(e);
      // eslint-disable-next-line no-console
      console.warn(e);
    }
  </script>
  <script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
      dataLayer.push(arguments);
    }

    window.emarsysCategoryBreadcrumb = window.emarsysCategoryBreadcrumb || "";
    var GTMurl = document.location.href, dataGTM = "";
    "/" === document.location.pathname ? dataGTM = "HOME" : 1 < GTMurl.indexOf("/users") ? dataGTM = 1 < GTMurl.indexOf("/login") ? "LOGIN" : 1 < GTMurl.indexOf("/register") ? "REGISTER" : "USERS" : 1 < GTMurl.indexOf("/product-list") ? dataGTM = "PRODUCT-LIST" : 1 < GTMurl.indexOf("/profile/") ? dataGTM = "PROFILE" : 1 < GTMurl.indexOf("/page/") ? dataGTM = "STATIC-PAGE" : 1 < GTMurl.indexOf("/brand") ? dataGTM = "BRAND" : 1 < GTMurl.indexOf("/seller") ? dataGTM = "SELLER" : 1 < GTMurl.indexOf("/product") ? dataGTM = "PDP" : 1 < GTMurl.indexOf("/cart") ? dataGTM = "CART" : 1 < GTMurl.indexOf("/shipping") ? dataGTM = "CHECKOUT - Shipping" : 1 < GTMurl.indexOf("/checkout") || 1 < GTMurl.lastIndexOf("/cash-on-delivery") ? dataGTM = "THANKYOUPAGE" : 1 < GTMurl.indexOf("/payment/") ? dataGTM = "CHECKOUT - Payment" : 1 < GTMurl.indexOf("/landing-page") ? dataGTM = "LANDING PAGES" : 1 < GTMurl.indexOf("/compare") ? dataGTM = "COMPARE" : 1 < GTMurl.indexOf("/search") ? dataGTM = 1 < GTMurl.indexOf("q=") ? 1 < GTMurl.indexOf("entry=mm") ? "megamenu" : "SEARCH" : "PLP" : 1 < GTMurl.indexOf("main") ? dataGTM = "CMP" : 1 < GTMurl.indexOf("/incredible-offers") ? dataGTM = "INCREDIBLE OFFER" : 1 < GTMurl.indexOf("/my-digikala") ? dataGTM = "MYDIGIKAL" : 1 < GTMurl.indexOf("/promotion-page/") && (dataGTM = "PROMOTION");
    dataLayer.push({
      "pageCategory": [dataGTM]
    });

    gtag('js', new Date());
    if (!window.module_GTM_demo) {
      gtag('config', 'UA-13212406-1', {'send_page_view': false});
    }
  </script>
  <!-- End Insider Javascript -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="shortcut icon" href="{{ !is_null($favicon_image)? $site_url . '/' . $favicon_image->path . '/'. $favicon_image->name : '' }}" type="image/icon">
  <link rel="icon" type="image/png"
        href="{{ !is_null($favicon_image)? $site_url . '/' . $favicon_image->path . '/'. $favicon_image->name : '' }}">
  <meta name="robots" content="noindex, nofollow"/>
  <link rel="canonical" href="{{ $site_url }}/shipping"/>

  <meta name="msapplication-TileColor" content="#ffffff">
  {{--  <meta name="msapplication-TileImage" content="/ms-icon-144x144.png">--}}
  <meta name="theme-color" content="#fb3449">
  <meta name="msapplication-navbutton-color" content="#fb3449">
  <meta name="apple-mobile-web-app-status-bar-style" content="#fb3449">
  <script>
    try {
      var _ajax = $.ajax;
      if (_ajax) {
        $.ajax = function () {
          if (arguments && arguments[0] && arguments[0].url && /mal{1,2}tina/gi.test(arguments[0].url)) {
            return;
          }
          return _ajax.apply($, arguments);
        };
      }
    } catch (e) {
    }
  </script>

  <link rel="stylesheet" href="{{ asset('assets/css/app.css') }} ">
  <link rel="stylesheet" href="{{ asset('assets/css/max-height1184px.css') }} "
        media="screen and (max-height: 1184px)">
  <link rel="stylesheet" href="{{ asset('assets/css/max-width1365px.css') }} "
        media="screen and (max-width: 1365px)">
  <link rel="stylesheet" href="{{ asset('assets/css/min-width1025px.css') }} "
        media="screen and (min-width: 1025px)">
  <link rel="stylesheet" href="{{ asset('assets/css/min-width1366px.css') }} "
        media="screen and (min-width: 1366px)">
  <link rel="stylesheet" href="{{ asset('assets/css/min-width1680px.css') }} "
        media="screen and (min-width: 1680px)">

  <meta name="csrf-token" content="{{ csrf_token() }}">

  <script>
    var supernova_mode = "production";
    var userInformation = {
      "firstName": "{{ $customer->first_name }}",
      "lastName": "{{ $customer->last_name }}",
      "nationalSecurityNumber": "{{ $customer->national_code }}",
      "mobile": "{{ !is_null($customer->mobile)? 0 . $customer->mobile : "" }}"
    };
    // var addressAjaxUrls = {
    //   "add": "\/ajax\/shipping\/addresses\/add\/",
    //   "edit": "\/ajax\/shipping\/addresses\/edit\/",
    //   "delete": "\/ajax\/shipping\/address\/remove\/"
    // };
    var pageName = "Shipping";
    // var hasInvalidItem = false;
    // var defaultShippingMode = "normal";
    // var fmcgProducts = [
    //   {
    //   "id": 2161415,
    //   "default_variant_id": 6100184,
    //   "add_to_cart_url": "\/cart\/add\/6100184\/1\/",
    //   "url": "\/product\/dkp-2161415\/\u06a9\u0631\u0647-\u0633\u0646\u062a\u06cc-\u0634\u06a9\u0644\u06cc-\u0645\u0642\u062f\u0627\u0631-100-\u06af\u0631\u0645",
    //   "title": "\u06a9\u0631\u0647 \u0633\u0646\u062a\u06cc \u0634\u06a9\u0644\u06cc \u0645\u0642\u062f\u0627\u0631 100 \u06af\u0631\u0645",
    //   "image": "https:\/\/dkstatics-public.digikala.com\/digikala-products\/114087213.jpg?x-oss-process=image\/resize,m_lfit,h_350,w_350\/quality,q_60",
    //   "image_src": "https:\/\/dkstatics-public.digikala.com\/digikala-products\/114087213.jpg?x-oss-process=image\/resize,m_lfit,h_350,w_350\/quality,q_60",
    //   "defaultLang": "fa",
    //   "price": {
    //     "rrp_price": 100000,
    //     "selling_price": 98000,
    //     "discount_percent": 2,
    //     "marketable_stock": 752,
    //     "orderLimit": 5,
    //     "is_incredible_offer": false,
    //     "is_sponsored_offer": false,
    //     "timer": null,
    //     "plus_variant_cash_back": 5000,
    //     "remaining_percentage": 75
    //   },
    //   "has_quick_view": true,
    //   "fast_shopping_badge": true,
    //   "fast_shopping_confirm": true,
    //   "category": "Butter",
    //   "brand": "Shakelli",
    //   "index_attributes": [],
    //   "rating": {
    //     "rating": 87.4,
    //     "count": 7324
    //   },
    //   "has_selling_stock": true,
    //   "status": "marketable",
    //   "product_parameters": {
    //     "seller": {
    //       "count": 1
    //     },
    //     "index_attributes": [],
    //     "warranty": {
    //       "count": 1
    //     }
    //   },
    //   "cpc_data": null,
    //   "badge": {
    //     "is_incredible_offer": false,
    //     "is_selling_and_sales": true,
    //     "has_promotion_badge": true,
    //     "is_plus_promotion": false,
    //     "is_early_access": false,
    //     "is_app_incredible": false,
    //     "is_themeable": false,
    //     "title": "\u0641\u0631\u0648\u0634 \u0648\u06cc\u0698\u0647",
    //     "color": null,
    //     "image": null
    //   },
    //   "has_promotion_stock": true
    // },
    // ];
    // var userFastShippingPurchaseHistory = {
    //   "header": {
    //     "title": "\u067e\u0631\u062a\u06a9\u0631\u0627\u0631\u062a\u0631\u06cc\u0646 \u062e\u0631\u06cc\u062f\u0647\u0627\u06cc \u0634\u0645\u0627",
    //     "title_en": "Frequently bought products"
    //   },
    //   "data_layer": "{\"event\":\"eec.productImpression\",\"ecommerce\":{\"currencyCode\":\"EUR\",\"impressions\":[{\"name\":\"\\u06a9\\u0631\\u0645 \\u062a\\u0631\\u06a9 \\u062f\\u0633\\u062a \\u0648 \\u067e\\u0627 \\u062c\\u06cc \\u0645\\u062f\\u0644 Br001 \\u062d\\u062c\\u0645 50 \\u0645\\u06cc\\u0644\\u06cc\\u200c\\u0644\\u06cc\\u062a\\u0631\",\"id\":841139,\"price\":137400,\"brand\":\"\\u062c\\u06cc\",\"category\":\"\\u06a9\\u0631\\u0645 \\u0648 \\u0631\\u0648\\u063a\\u0646 \\u0631\\u0641\\u0639 \\u062a\\u0631\\u06a9 \\u0628\\u062f\\u0646\",\"list\":\"category-\\u06a9\\u0631\\u0645 \\u0648 \\u0631\\u0648\\u063a\\u0646 \\u0631\\u0641\\u0639 \\u062a\\u0631\\u06a9 \\u0628\\u062f\\u0646\",\"position\":1,\"dimension6\":1,\"dimension2\":14,\"dimension9\":4.5,\"metric6\":4747,\"dimension11\":0,\"dimension20\":\"marketable\",\"dimension18\":\"most-viewed\",\"dimension19\":\"selected-from-fresh\",\"dimension7\":\"none\"},{\"name\":\"\\u06a9\\u0631\\u0647 \\u0633\\u0646\\u062a\\u06cc \\u0634\\u06a9\\u0644\\u06cc \\u0645\\u0642\\u062f\\u0627\\u0631 100 \\u06af\\u0631\\u0645\",\"id\":2161415,\"price\":98000,\"brand\":\"\\u0634\\u06a9\\u0644\\u06cc\",\"category\":\"\\u06a9\\u0631\\u0647 \\u062d\\u06cc\\u0648\\u0627\\u0646\\u06cc \\u0648 \\u06af\\u06cc\\u0627\\u0647\\u06cc\",\"list\":\"category-\\u06a9\\u0631\\u0647 \\u062d\\u06cc\\u0648\\u0627\\u0646\\u06cc \\u0648 \\u06af\\u06cc\\u0627\\u0647\\u06cc\",\"position\":2,\"dimension6\":1,\"dimension2\":2,\"dimension9\":4.4,\"metric6\":7324,\"dimension11\":1,\"dimension20\":\"marketable\",\"dimension18\":\"most-viewed\",\"dimension19\":\"selected-from-fresh\",\"dimension7\":\"special-offer\"},{\"name\":\"\\u0634\\u06cc\\u0631 \\u0646\\u06cc\\u0645 \\u0686\\u0631\\u0628 \\u0627\\u0631\\u06af\\u0627\\u0646\\u06cc\\u06a9 \\u06a9\\u0648\\u0647\\u067e\\u0646\\u0627\\u0647 \\u0645\\u0642\\u062f\\u0627\\u0631 940 \\u0645\\u06cc\\u0644\\u06cc \\u0644\\u06cc\\u062a\\u0631\",\"id\":784631,\"price\":127000,\"brand\":\"\\u06a9\\u0648\\u0647\\u067e\\u0646\\u0627\\u0647\",\"category\":\"\\u0634\\u06cc\\u0631\",\"list\":\"category-\\u0634\\u06cc\\u0631\",\"position\":3,\"dimension6\":1,\"dimension2\":0,\"dimension9\":4.5,\"metric6\":9943,\"dimension11\":1,\"dimension20\":\"marketable\",\"dimension18\":\"most-viewed\",\"dimension19\":\"selected-from-fresh\",\"dimension7\":\"none\"},{\"name\":\"\\u06a9\\u0646\\u0633\\u0631\\u0648 \\u0645\\u0627\\u0647\\u06cc \\u062a\\u0648\\u0646 \\u062f\\u0631 \\u0631\\u0648\\u063a\\u0646 \\u06af\\u06cc\\u0627\\u0647\\u06cc \\u0637\\u0628\\u06cc\\u0639\\u062a - 180 \\u06af\\u0631\\u0645\",\"id\":847467,\"price\":195000,\"brand\":\"\\u0637\\u0628\\u06cc\\u0639\\u062a\",\"category\":\"\\u06a9\\u0646\\u0633\\u0631\\u0648 \\u0645\\u0627\\u0647\\u06cc\",\"list\":\"category-\\u06a9\\u0646\\u0633\\u0631\\u0648 \\u0645\\u0627\\u0647\\u06cc\",\"position\":4,\"dimension6\":1,\"dimension2\":30,\"dimension9\":4.3,\"metric6\":11620,\"dimension11\":1,\"dimension20\":\"marketable\",\"dimension18\":\"most-viewed\",\"dimension19\":\"selected-from-fresh\",\"dimension7\":\"incredible\"},{\"name\":\"\\u06af\\u0648\\u062c\\u0647 \\u0641\\u0631\\u0646\\u06af\\u06cc \\u0628\\u0648\\u062a\\u0647 \\u0627\\u06cc \\u0645\\u06cc\\u0648\\u0631\\u06cc - 1 \\u06a9\\u06cc\\u0644\\u0648\\u06af\\u0631\\u0645\",\"id\":4418767,\"price\":109800,\"brand\":\"\\u0645\\u06cc\\u0648\\u0631\\u06cc\",\"category\":\"\\u0635\\u06cc\\u0641\\u06cc \\u0648 \\u0633\\u0628\\u0632\\u06cc\\u062c\\u0627\\u062a\",\"list\":\"category-\\u0635\\u06cc\\u0641\\u06cc \\u0648 \\u0633\\u0628\\u0632\\u06cc\\u062c\\u0627\\u062a\",\"position\":5,\"dimension6\":1,\"dimension2\":11,\"dimension9\":4.1,\"metric6\":719,\"dimension11\":1,\"dimension20\":\"marketable\",\"dimension18\":\"most-viewed\",\"dimension19\":\"selected-from-fresh\",\"dimension7\":\"special-offer\"},{\"name\":\"\\u0642\\u0631\\u0635 \\u0645\\u0627\\u0634\\u06cc\\u0646 \\u0638\\u0631\\u0641\\u0634\\u0648\\u06cc\\u06cc \\u0647\\u0648\\u0645 \\u067e\\u0644\\u0627\\u0633 \\u0645\\u062f\\u0644 Lemon \\u0628\\u0633\\u062a\\u0647 24 \\u0639\\u062f\\u062f\\u06cc\",\"id\":3431048,\"price\":830000,\"brand\":\"\\u0647\\u0648\\u0645 \\u067e\\u0644\\u0627\\u0633\",\"category\":\"\\u0634\\u0648\\u06cc\\u0646\\u062f\\u0647 \\u0638\\u0631\\u0648\\u0641\",\"list\":\"category-\\u0634\\u0648\\u06cc\\u0646\\u062f\\u0647 \\u0638\\u0631\\u0648\\u0641\",\"position\":6,\"dimension6\":1,\"dimension2\":0,\"dimension9\":4.4,\"metric6\":6211,\"dimension11\":1,\"dimension20\":\"marketable\",\"dimension18\":\"most-viewed\",\"dimension19\":\"selected-from-fresh\",\"dimension7\":\"none\"},{\"name\":\"\\u0633\\u0633 \\u06af\\u0648\\u062c\\u0647 \\u0641\\u0631\\u0646\\u06af\\u06cc \\u0628\\u06cc\\u0698\\u0646 \\u0648\\u0632\\u0646 550 \\u06af\\u0631\\u0645\",\"id\":1481847,\"price\":135000,\"brand\":\"\\u0628\\u06cc\\u0698\\u0646\",\"category\":\"\\u0633\\u0633\",\"list\":\"category-\\u0633\\u0633\",\"position\":7,\"dimension6\":1,\"dimension2\":0,\"dimension9\":4.4,\"metric6\":4964,\"dimension11\":1,\"dimension20\":\"marketable\",\"dimension18\":\"most-viewed\",\"dimension19\":\"selected-from-fresh\",\"dimension7\":\"none\"},{\"name\":\"\\u0645\\u0648\\u0632 \\u0641\\u0644\\u0647 - 1 \\u06a9\\u06cc\\u0644\\u0648\\u06af\\u0631\\u0645\",\"id\":857042,\"price\":274300,\"brand\":\"\\u0645\\u062a\\u0641\\u0631\\u0642\\u0647\",\"category\":\"\\u0645\\u06cc\\u0648\\u0647\",\"list\":\"category-\\u0645\\u06cc\\u0648\\u0647\",\"position\":8,\"dimension6\":1,\"dimension2\":7,\"dimension9\":4,\"metric6\":2177,\"dimension11\":1,\"dimension20\":\"marketable\",\"dimension18\":\"most-viewed\",\"dimension19\":\"selected-from-fresh\",\"dimension7\":\"special-offer\"},{\"name\":\"\\u0631\\u0648\\u063a\\u0646 \\u0645\\u062e\\u0635\\u0648\\u0635 \\u0633\\u0631\\u062e \\u06a9\\u0631\\u062f\\u0646\\u06cc \\u0628\\u0647\\u0627\\u0631 - 1.5 \\u0644\\u06cc\\u062a\\u0631\",\"id\":1537796,\"price\":160000,\"brand\":\"\\u0628\\u0647\\u0627\\u0631\",\"category\":\"\\u0631\\u0648\\u063a\\u0646\",\"list\":\"category-\\u0631\\u0648\\u063a\\u0646\",\"position\":9,\"dimension6\":1,\"dimension2\":0,\"dimension9\":4.5,\"metric6\":5543,\"dimension11\":1,\"dimension20\":\"marketable\",\"dimension18\":\"most-viewed\",\"dimension19\":\"selected-from-fresh\",\"dimension7\":\"none\"},{\"name\":\"\\u0633\\u064a\\u0628 \\u0632\\u0645\\u064a\\u0646\\u064a \\u0645\\u064a\\u0648\\u0631\\u064a - 2 \\u06a9\\u064a\\u0644\\u0648\\u06af\\u0631\\u0645\\t\",\"id\":4365879,\"price\":119800,\"brand\":\"\\u0645\\u06cc\\u0648\\u0631\\u06cc\",\"category\":\"\\u0635\\u06cc\\u0641\\u06cc \\u0648 \\u0633\\u0628\\u0632\\u06cc\\u062c\\u0627\\u062a\",\"list\":\"category-\\u0635\\u06cc\\u0641\\u06cc \\u0648 \\u0633\\u0628\\u0632\\u06cc\\u062c\\u0627\\u062a\",\"position\":10,\"dimension6\":1,\"dimension2\":11,\"dimension9\":4,\"metric6\":630,\"dimension11\":1,\"dimension20\":\"marketable\",\"dimension18\":\"most-viewed\",\"dimension19\":\"selected-from-fresh\",\"dimension7\":\"special-offer\"},{\"name\":\"\\u062e\\u0631\\u0645\\u0627 \\u0639\\u0633\\u0644\\u06cc \\u062a\\u0627\\u0632\\u0647 \\u0645\\u0642\\u062f\\u0627\\u0631 800 \\u06af\\u0631\\u0645\",\"id\":1464601,\"price\":220000,\"brand\":\"\\u0645\\u062a\\u0641\\u0631\\u0642\\u0647\",\"category\":\"\\u062e\\u0631\\u0645\\u0627\",\"list\":\"category-\\u062e\\u0631\\u0645\\u0627\",\"position\":11,\"dimension6\":1,\"dimension2\":0,\"dimension9\":4.3,\"metric6\":1102,\"dimension11\":1,\"dimension20\":\"marketable\",\"dimension18\":\"most-viewed\",\"dimension19\":\"selected-from-fresh\",\"dimension7\":\"none\"},{\"name\":\"\\u0645\\u0627\\u06a9\\u0627\\u0631\\u0648\\u0646\\u06cc \\u067e\\u0646\\u0647 \\u0631\\u06cc\\u06af\\u0627\\u062a\\u0647 \\u0632\\u0631 \\u0645\\u0627\\u06a9\\u0627\\u0631\\u0648\\u0646 \\u0645\\u0642\\u062f\\u0627\\u0631 500 \\u06af\\u0631\\u0645\",\"id\":633507,\"price\":73600,\"brand\":\"\\u0632\\u0631\\u0645\\u0627\\u06a9\\u0627\\u0631\\u0648\\u0646\",\"category\":\"\\u0645\\u0627\\u06a9\\u0627\\u0631\\u0648\\u0646\\u06cc\\u060c \\u067e\\u0627\\u0633\\u062a\\u0627 \\u0648 \\u0631\\u0634\\u062a\\u0647\",\"list\":\"category-\\u0645\\u0627\\u06a9\\u0627\\u0631\\u0648\\u0646\\u06cc\\u060c \\u067e\\u0627\\u0633\\u062a\\u0627 \\u0648 \\u0631\\u0634\\u062a\\u0647\",\"position\":12,\"dimension6\":1,\"dimension2\":0,\"dimension9\":4.4,\"metric6\":5730,\"dimension11\":1,\"dimension20\":\"marketable\",\"dimension18\":\"most-viewed\",\"dimension19\":\"selected-from-fresh\",\"dimension7\":\"none\"},{\"name\":\"\\u067e\\u0648\\u062f\\u0631 \\u0645\\u0627\\u0634\\u06cc\\u0646 \\u0638\\u0631\\u0641\\u0634\\u0648\\u06cc\\u06cc \\u067e\\u0631\\u06cc\\u0644 \\u0645\\u0642\\u062f\\u0627\\u0631 1 \\u06a9\\u06cc\\u0644\\u0648\\u06af\\u0631\\u0645\",\"id\":3886246,\"price\":565000,\"brand\":\"\\u067e\\u0631\\u06cc\\u0644\",\"category\":\"\\u0634\\u0648\\u06cc\\u0646\\u062f\\u0647 \\u0638\\u0631\\u0648\\u0641\",\"list\":\"category-\\u0634\\u0648\\u06cc\\u0646\\u062f\\u0647 \\u0638\\u0631\\u0648\\u0641\",\"position\":13,\"dimension6\":1,\"dimension2\":13,\"dimension9\":4.3,\"metric6\":1919,\"dimension11\":1,\"dimension20\":\"marketable\",\"dimension18\":\"most-viewed\",\"dimension19\":\"selected-from-fresh\",\"dimension7\":\"incredible\"},{\"name\":\"\\u0645\\u0627\\u06cc\\u0639 \\u0638\\u0631\\u0641\\u0634\\u0648\\u06cc\\u06cc \\u067e\\u0631\\u06cc\\u0644 5+ \\u0628\\u0627 \\u0631\\u0627\\u06cc\\u062d\\u0647 \\u0644\\u06cc\\u0645\\u0648 \\u0645\\u0642\\u062f\\u0627\\u0631 3.75 \\u06a9\\u06cc\\u0644\\u0648\\u06af\\u0631\\u0645\",\"id\":3754869,\"price\":644000,\"brand\":\"\\u067e\\u0631\\u06cc\\u0644\",\"category\":\"\\u0634\\u0648\\u06cc\\u0646\\u062f\\u0647 \\u0638\\u0631\\u0648\\u0641\",\"list\":\"category-\\u0634\\u0648\\u06cc\\u0646\\u062f\\u0647 \\u0638\\u0631\\u0648\\u0641\",\"position\":14,\"dimension6\":1,\"dimension2\":0,\"dimension9\":4.5,\"metric6\":942,\"dimension11\":1,\"dimension20\":\"marketable\",\"dimension18\":\"most-viewed\",\"dimension19\":\"selected-from-fresh\",\"dimension7\":\"none\"},{\"name\":\"\\u067e\\u0648\\u062f\\u0631 \\u0645\\u0627\\u0634\\u06cc\\u0646 \\u0644\\u0628\\u0627\\u0633\\u0634\\u0648\\u06cc\\u06cc \\u067e\\u0631\\u0633\\u06cc\\u0644 \\u0645\\u062f\\u0644 \\u06cc\\u0648\\u0646\\u06cc\\u0648\\u0631\\u0633\\u0627\\u0644 \\u0645\\u0642\\u062f\\u0627\\u0631 500 \\u06af\\u0631\\u0645 - \\u0645\\u062c\\u0645\\u0648\\u0639\\u0647 5 \\u0639\\u062f\\u062f\\u06cc \\u062a\\u062e\\u0641\\u06cc\\u0641 \\u062f\\u0627\\u0631\",\"id\":4104531,\"price\":567000,\"brand\":\"\\u067e\\u0631\\u0633\\u06cc\\u0644\",\"category\":\"\\u0634\\u0648\\u06cc\\u0646\\u062f\\u0647 \\u0644\\u0628\\u0627\\u0633\",\"list\":\"category-\\u0634\\u0648\\u06cc\\u0646\\u062f\\u0647 \\u0644\\u0628\\u0627\\u0633\",\"position\":15,\"dimension6\":1,\"dimension2\":10,\"dimension9\":4.4,\"metric6\":1047,\"dimension11\":1,\"dimension20\":\"marketable\",\"dimension18\":\"most-viewed\",\"dimension19\":\"selected-from-fresh\",\"dimension7\":\"none\"},{\"name\":\"\\u0645\\u0627\\u0633\\u062a \\u0633\\u0628\\u0648 \\u067e\\u0631\\u0648\\u0628\\u06cc\\u0648\\u062a\\u06cc\\u06a9 \\u0647\\u0631\\u0627\\u0632 - 2 \\u06a9\\u06cc\\u0644\\u0648\\u06af\\u0631\\u0645\",\"id\":1485662,\"price\":264000,\"brand\":\"\\u0647\\u0631\\u0627\\u0632\",\"category\":\"\\u0645\\u0627\\u0633\\u062a\",\"list\":\"category-\\u0645\\u0627\\u0633\\u062a\",\"position\":16,\"dimension6\":1,\"dimension2\":26,\"dimension9\":4.5,\"metric6\":3720,\"dimension11\":1,\"dimension20\":\"marketable\",\"dimension18\":\"most-viewed\",\"dimension19\":\"selected-from-fresh\",\"dimension7\":\"incredible\"},{\"name\":\"\\u0627\\u0633\\u067e\\u0627\\u06af\\u062a\\u06cc \\u0642\\u0637\\u0631 1.2 \\u0632\\u0631 \\u0645\\u0627\\u06a9\\u0627\\u0631\\u0648\\u0646 \\u0645\\u0642\\u062f\\u0627\\u0631 700 \\u06af\\u0631\\u0645\",\"id\":633380,\"price\":86000,\"brand\":\"\\u0632\\u0631\\u0645\\u0627\\u06a9\\u0627\\u0631\\u0648\\u0646\",\"category\":\"\\u0645\\u0627\\u06a9\\u0627\\u0631\\u0648\\u0646\\u06cc\\u060c \\u067e\\u0627\\u0633\\u062a\\u0627 \\u0648 \\u0631\\u0634\\u062a\\u0647\",\"list\":\"category-\\u0645\\u0627\\u06a9\\u0627\\u0631\\u0648\\u0646\\u06cc\\u060c \\u067e\\u0627\\u0633\\u062a\\u0627 \\u0648 \\u0631\\u0634\\u062a\\u0647\",\"position\":17,\"dimension6\":1,\"dimension2\":0,\"dimension9\":4.4,\"metric6\":6359,\"dimension11\":1,\"dimension20\":\"marketable\",\"dimension18\":\"most-viewed\",\"dimension19\":\"selected-from-fresh\",\"dimension7\":\"none\"},{\"name\":\"\\u062e\\u06cc\\u0627\\u0631\\u0634\\u0648\\u0631 \\u0642\\u0644\\u0645\\u06cc \\u0627\\u0635\\u0627\\u0644\\u062a - 1.5 \\u06a9\\u06cc\\u0644\\u0648\\u06af\\u0631\\u0645 \",\"id\":3712166,\"price\":450000,\"brand\":\"\\u0627\\u0635\\u0627\\u0644\\u062a\",\"category\":\"\\u062e\\u06cc\\u0627\\u0631\\u0634\\u0648\\u0631 \\u0648 \\u062a\\u0631\\u0634\\u06cc\\u062c\\u0627\\u062a\",\"list\":\"category-\\u062e\\u06cc\\u0627\\u0631\\u0634\\u0648\\u0631 \\u0648 \\u062a\\u0631\\u0634\\u06cc\\u062c\\u0627\\u062a\",\"position\":18,\"dimension6\":1,\"dimension2\":0,\"dimension9\":4.4,\"metric6\":1769,\"dimension11\":1,\"dimension20\":\"marketable\",\"dimension18\":\"most-viewed\",\"dimension19\":\"selected-from-fresh\",\"dimension7\":\"none\"},{\"name\":\"\\u062e\\u0627\\u0645\\u0647 \\u0635\\u0628\\u062d\\u0627\\u0646\\u0647 \\u0645\\u06cc\\u0647\\u0646 \\u0645\\u0642\\u062f\\u0627\\u0631 200 \\u06af\\u0631\\u0645\",\"id\":888686,\"price\":120000,\"brand\":\"\\u0645\\u06cc\\u0647\\u0646\",\"category\":\"\\u062e\\u0627\\u0645\\u0647\",\"list\":\"category-\\u062e\\u0627\\u0645\\u0647\",\"position\":19,\"dimension6\":1,\"dimension2\":0,\"dimension9\":4.4,\"metric6\":3766,\"dimension11\":1,\"dimension20\":\"marketable\",\"dimension18\":\"most-viewed\",\"dimension19\":\"selected-from-fresh\",\"dimension7\":\"none\"},{\"name\":\"\\u0642\\u0627\\u0631\\u0686 \\u062f\\u06a9\\u0645\\u0647\\u200c \\u0627\\u06cc \\u06a9\\u0627\\u0645\\u0644 \\u0645\\u0644\\u0627\\u0631\\u062f - 400 \\u06af\\u0631\\u0645\",\"id\":784830,\"price\":188500,\"brand\":\"\\u0645\\u0644\\u0627\\u0631\\u062f\",\"category\":\"\\u0635\\u06cc\\u0641\\u06cc \\u0648 \\u0633\\u0628\\u0632\\u06cc\\u062c\\u0627\\u062a\",\"list\":\"category-\\u0635\\u06cc\\u0641\\u06cc \\u0648 \\u0633\\u0628\\u0632\\u06cc\\u062c\\u0627\\u062a\",\"position\":20,\"dimension6\":1,\"dimension2\":14,\"dimension9\":4.3,\"metric6\":9103,\"dimension11\":1,\"dimension20\":\"marketable\",\"dimension18\":\"most-viewed\",\"dimension19\":\"selected-from-fresh\",\"dimension7\":\"special-offer\"}]}}",
    //   "products": [
    //     {
    //     "id": 841139,
    //     "default_variant_id": 10530607,
    //     "add_to_cart_url": "\/cart\/add\/10530607\/1\/",
    //     "url": "\/product\/dkp-841139\/\u06a9\u0631\u0645-\u062a\u0631\u06a9-\u062f\u0633\u062a-\u0648-\u067e\u0627-\u062c\u06cc-\u0645\u062f\u0644-br001-\u062d\u062c\u0645-50-\u0645\u06cc\u0644\u06cc\u0644\u06cc\u062a\u0631",
    //     "title": "\u06a9\u0631\u0645 \u062a\u0631\u06a9 \u062f\u0633\u062a \u0648 \u067e\u0627 \u062c\u06cc \u0645\u062f\u0644 Br001 \u062d\u062c\u0645 50 \u0645\u06cc\u0644\u06cc\u200c\u0644\u06cc\u062a\u0631",
    //     "image": "https:\/\/dkstatics-public.digikala.com\/digikala-products\/110235065.jpg?x-oss-process=image\/resize,m_lfit,h_350,w_350\/quality,q_60",
    //     "image_src": "https:\/\/dkstatics-public.digikala.com\/digikala-products\/110235065.jpg?x-oss-process=image\/resize,m_lfit,h_350,w_350\/quality,q_60",
    //     "defaultLang": "fa",
    //     "price": {
    //       "rrp_price": 160000,
    //       "selling_price": 137400,
    //       "discount_percent": 0,
    //       "marketable_stock": 864,
    //       "orderLimit": 30,
    //       "is_incredible_offer": false,
    //       "is_sponsored_offer": false,
    //       "timer": null,
    //       "plus_variant_cash_back": 0,
    //       "remaining_percentage": null
    //     },
    //     "has_quick_view": true,
    //     "fast_shopping_badge": false,
    //     "fast_shopping_confirm": false,
    //     "category": "\u06a9\u0631\u0645 \u0648 \u0631\u0648\u063a\u0646 \u0631\u0641\u0639 \u062a\u0631\u06a9 \u0628\u062f\u0646",
    //     "brand": "\u062c\u06cc",
    //     "index_attributes": [{
    //       "id": 19803,
    //       "title": "\u0648\u06cc\u062a\u0627\u0645\u06cc\u0646",
    //       "postfix": null,
    //       "prefix": null,
    //       "textValue": null,
    //       "sort": 2,
    //       "values": [{
    //         "id": 23928,
    //         "code": "no",
    //         "title": "\u0646\u062f\u0627\u0631\u062f"
    //       }]
    //     },
    //       {
    //         "id": 19805,
    //         "title": "\u0639\u0635\u0627\u0631\u0647",
    //         "postfix": null,
    //         "prefix": null,
    //         "textValue": null,
    //         "sort": 4,
    //         "values": [{
    //           "id": 23931,
    //           "code": "no",
    //           "title": "\u0646\u062f\u0627\u0631\u062f"
    //         }]
    //       },
    //       {
    //         "id": 19806,
    //         "title": "\u0646\u0648\u0639 \u0645\u062d\u0641\u0638\u0647 \u0646\u06af\u0647 \u062f\u0627\u0631\u0646\u062f\u0647",
    //         "postfix": null,
    //         "prefix": "- \u0646\u0648\u0639 \u0645\u062d\u0641\u0638\u0647 \u0646\u06af\u0647 \u062f\u0627\u0631\u0646\u062f\u0647:",
    //         "textValue": null,
    //         "sort": 6,
    //         "values": [{
    //           "id": 23932,
    //           "code": "tupe",
    //           "title": "\u062a\u06cc\u0648\u067e\u06cc"
    //         }]
    //       },
    //       {
    //         "id": 19808,
    //         "title": "\u06a9\u0634\u0648\u0631 \u0645\u0628\u062f\u0627 \u0628\u0631\u0646\u062f",
    //         "postfix": null,
    //         "prefix": "- \u06a9\u0634\u0648\u0631 \u0645\u0628\u062f\u0627 \u0628\u0631\u0646\u062f:",
    //         "textValue": null,
    //         "sort": 8,
    //         "values": [{
    //           "id": 23936,
    //           "code": "iran",
    //           "title": "\u0627\u06cc\u0631\u0627\u0646"
    //         }]
    //       }],
    //     "rating": {
    //       "rating": 89,
    //       "count": 4747
    //     },
    //     "has_selling_stock": true,
    //     "status": "marketable",
    //     "product_parameters": {
    //       "seller": {
    //         "count": 44
    //       },
    //       "index_attributes": [{
    //         "id": 19803,
    //         "title": "\u0648\u06cc\u062a\u0627\u0645\u06cc\u0646",
    //         "postfix": null,
    //         "prefix": null,
    //         "textValue": null,
    //         "sort": 2,
    //         "values": [{
    //           "id": 23928,
    //           "code": "no",
    //           "title": "\u0646\u062f\u0627\u0631\u062f"
    //         }]
    //       },
    //         {
    //           "id": 19805,
    //           "title": "\u0639\u0635\u0627\u0631\u0647",
    //           "postfix": null,
    //           "prefix": null,
    //           "textValue": null,
    //           "sort": 4,
    //           "values": [{
    //             "id": 23931,
    //             "code": "no",
    //             "title": "\u0646\u062f\u0627\u0631\u062f"
    //           }]
    //         },
    //         {
    //           "id": 19806,
    //           "title": "\u0646\u0648\u0639 \u0645\u062d\u0641\u0638\u0647 \u0646\u06af\u0647 \u062f\u0627\u0631\u0646\u062f\u0647",
    //           "postfix": null,
    //           "prefix": "- \u0646\u0648\u0639 \u0645\u062d\u0641\u0638\u0647 \u0646\u06af\u0647 \u062f\u0627\u0631\u0646\u062f\u0647:",
    //           "textValue": null,
    //           "sort": 6,
    //           "values": [{
    //             "id": 23932,
    //             "code": "tupe",
    //             "title": "\u062a\u06cc\u0648\u067e\u06cc"
    //           }]
    //         },
    //         {
    //           "id": 19808,
    //           "title": "\u06a9\u0634\u0648\u0631 \u0645\u0628\u062f\u0627 \u0628\u0631\u0646\u062f",
    //           "postfix": null,
    //           "prefix": "- \u06a9\u0634\u0648\u0631 \u0645\u0628\u062f\u0627 \u0628\u0631\u0646\u062f:",
    //           "textValue": null,
    //           "sort": 8,
    //           "values": [{
    //             "id": 23936,
    //             "code": "iran",
    //             "title": "\u0627\u06cc\u0631\u0627\u0646"
    //           }]
    //         }],
    //       "warranty": {
    //         "count": 3
    //       }
    //     },
    //     "cpc_data": null,
    //     "badge": null,
    //     "has_promotion_stock": false
    //   },
    // };
    // var snDeliveryOptions = {
    //   "delivery_options": {
    //     "eco": [{
    //       "product_ids": {
    //         "1130176984": 1977404
    //       },
    //       "available_time_windows": {
    //         "\u062f\u0648\u200c\u0634\u0646\u0628\u0647": [{
    //           "from": 19,
    //           "to": 22
    //         }],
    //         "\u0633\u0647\u200c\u0634\u0646\u0628\u0647": [{
    //           "from": 9,
    //           "to": 12
    //         },
    //           {
    //             "from": 11,
    //             "to": 14
    //           },
    //           {
    //             "from": 13,
    //             "to": 16
    //           },
    //           {
    //             "from": 15,
    //             "to": 18
    //           },
    //           {
    //             "from": 17,
    //             "to": 20
    //           },
    //           {
    //             "from": 19,
    //             "to": 22
    //           }]
    //       },
    //       "full_time_windows": []
    //     },
    //       {
    //         "product_ids": {
    //           "1130270410": 2217851,
    //           "1130270411": 4826524,
    //           "1130489950": 4142175
    //         },
    //         "available_time_windows": {
    //           "\u062f\u0648\u200c\u0634\u0646\u0628\u0647": [{
    //             "from": 9,
    //             "to": 12
    //           },
    //             {
    //               "from": 12,
    //               "to": 15
    //             },
    //             {
    //               "from": 15,
    //               "to": 18
    //             },
    //             {
    //               "from": 18,
    //               "to": 21
    //             }],
    //           "\u0633\u0647\u200c\u0634\u0646\u0628\u0647": [{
    //             "from": 9,
    //             "to": 12
    //           },
    //             {
    //               "from": 12,
    //               "to": 15
    //             },
    //             {
    //               "from": 15,
    //               "to": 18
    //             },
    //             {
    //               "from": 18,
    //               "to": 21
    //             }],
    //           "\u0686\u0647\u0627\u0631\u200c\u0634\u0646\u0628\u0647": [{
    //             "from": 9,
    //             "to": 12
    //           },
    //             {
    //               "from": 12,
    //               "to": 15
    //             },
    //             {
    //               "from": 15,
    //               "to": 18
    //             },
    //             {
    //               "from": 18,
    //               "to": 21
    //             }],
    //           "\u067e\u0646\u062c\u200c\u0634\u0646\u0628\u0647": [{
    //             "from": 9,
    //             "to": 12
    //           },
    //             {
    //               "from": 12,
    //               "to": 15
    //             },
    //             {
    //               "from": 15,
    //               "to": 18
    //             },
    //             {
    //               "from": 18,
    //               "to": 21
    //             }],
    //           "\u062c\u0645\u0639\u0647": [{
    //             "from": 9,
    //             "to": 12
    //           },
    //             {
    //               "from": 12,
    //               "to": 15
    //             },
    //             {
    //               "from": 15,
    //               "to": 18
    //             },
    //             {
    //               "from": 18,
    //               "to": 21
    //             }]
    //         },
    //         "full_time_windows": []
    //       }],
    //     "fast": [{
    //       "product_ids": {
    //         "1130176984": 1977404
    //       },
    //       "available_time_windows": {
    //         "\u062f\u0648\u200c\u0634\u0646\u0628\u0647": [{
    //           "from": 19,
    //           "to": 22
    //         }],
    //         "\u0633\u0647\u200c\u0634\u0646\u0628\u0647": [{
    //           "from": 9,
    //           "to": 12
    //         },
    //           {
    //             "from": 11,
    //             "to": 14
    //           },
    //           {
    //             "from": 13,
    //             "to": 16
    //           },
    //           {
    //             "from": 15,
    //             "to": 18
    //           },
    //           {
    //             "from": 17,
    //             "to": 20
    //           },
    //           {
    //             "from": 19,
    //             "to": 22
    //           }]
    //       },
    //       "full_time_windows": []
    //     },
    //       {
    //         "product_ids": {
    //           "1130270410": 2217851,
    //           "1130489950": 4142175
    //         },
    //         "available_time_windows": {
    //           "\u0686\u0647\u0627\u0631\u200c\u0634\u0646\u0628\u0647": [{
    //             "from": 9,
    //             "to": 12
    //           },
    //             {
    //               "from": 12,
    //               "to": 15
    //             },
    //             {
    //               "from": 15,
    //               "to": 18
    //             },
    //             {
    //               "from": 18,
    //               "to": 21
    //             }],
    //           "\u067e\u0646\u062c\u200c\u0634\u0646\u0628\u0647": [{
    //             "from": 9,
    //             "to": 12
    //           },
    //             {
    //               "from": 12,
    //               "to": 15
    //             },
    //             {
    //               "from": 15,
    //               "to": 18
    //             },
    //             {
    //               "from": 18,
    //               "to": 21
    //             }],
    //           "\u062c\u0645\u0639\u0647": [{
    //             "from": 9,
    //             "to": 12
    //           },
    //             {
    //               "from": 12,
    //               "to": 15
    //             },
    //             {
    //               "from": 15,
    //               "to": 18
    //             },
    //             {
    //               "from": 18,
    //               "to": 21
    //             }],
    //           "\u0634\u0646\u0628\u0647": [{
    //             "from": 9,
    //             "to": 12
    //           },
    //             {
    //               "from": 12,
    //               "to": 15
    //             },
    //             {
    //               "from": 15,
    //               "to": 18
    //             },
    //             {
    //               "from": 18,
    //               "to": 21
    //             }],
    //           "\u06cc\u06a9\u0634\u0646\u0628\u0647": [{
    //             "from": 9,
    //             "to": 12
    //           },
    //             {
    //               "from": 12,
    //               "to": 15
    //             },
    //             {
    //               "from": 15,
    //               "to": 18
    //             },
    //             {
    //               "from": 18,
    //               "to": 21
    //             }]
    //         },
    //         "full_time_windows": []
    //       },
    //       {
    //         "product_ids": {
    //           "1130270411": 4826524
    //         },
    //         "available_time_windows": {
    //           "\u062f\u0648\u200c\u0634\u0646\u0628\u0647": [{
    //             "from": 9,
    //             "to": 12
    //           },
    //             {
    //               "from": 12,
    //               "to": 15
    //             },
    //             {
    //               "from": 15,
    //               "to": 18
    //             },
    //             {
    //               "from": 18,
    //               "to": 21
    //             }],
    //           "\u0633\u0647\u200c\u0634\u0646\u0628\u0647": [{
    //             "from": 9,
    //             "to": 12
    //           },
    //             {
    //               "from": 12,
    //               "to": 15
    //             },
    //             {
    //               "from": 15,
    //               "to": 18
    //             },
    //             {
    //               "from": 18,
    //               "to": 21
    //             }],
    //           "\u0686\u0647\u0627\u0631\u200c\u0634\u0646\u0628\u0647": [{
    //             "from": 9,
    //             "to": 12
    //           },
    //             {
    //               "from": 12,
    //               "to": 15
    //             },
    //             {
    //               "from": 15,
    //               "to": 18
    //             },
    //             {
    //               "from": 18,
    //               "to": 21
    //             }],
    //           "\u067e\u0646\u062c\u200c\u0634\u0646\u0628\u0647": [{
    //             "from": 9,
    //             "to": 12
    //           },
    //             {
    //               "from": 12,
    //               "to": 15
    //             },
    //             {
    //               "from": 15,
    //               "to": 18
    //             },
    //             {
    //               "from": 18,
    //               "to": 21
    //             }],
    //           "\u062c\u0645\u0639\u0647": [{
    //             "from": 9,
    //             "to": 12
    //           },
    //             {
    //               "from": 12,
    //               "to": 15
    //             },
    //             {
    //               "from": 15,
    //               "to": 18
    //             },
    //             {
    //               "from": 18,
    //               "to": 21
    //             }]
    //         },
    //         "full_time_windows": []
    //       }],
    //     "normal": [{
    //       "product_ids": {
    //         "1130176984": 1977404
    //       },
    //       "available_time_windows": {
    //         "\u062f\u0648\u200c\u0634\u0646\u0628\u0647": [{
    //           "from": 19,
    //           "to": 22
    //         }],
    //         "\u0633\u0647\u200c\u0634\u0646\u0628\u0647": [{
    //           "from": 9,
    //           "to": 12
    //         },
    //           {
    //             "from": 11,
    //             "to": 14
    //           },
    //           {
    //             "from": 13,
    //             "to": 16
    //           },
    //           {
    //             "from": 15,
    //             "to": 18
    //           },
    //           {
    //             "from": 17,
    //             "to": 20
    //           },
    //           {
    //             "from": 19,
    //             "to": 22
    //           }]
    //       },
    //       "full_time_windows": []
    //     },
    //       {
    //         "product_ids": {
    //           "1130270410": 2217851,
    //           "1130270411": 4826524,
    //           "1130489950": 4142175
    //         },
    //         "available_time_windows": {
    //           "\u062f\u0648\u200c\u0634\u0646\u0628\u0647": [{
    //             "from": 9,
    //             "to": 12
    //           },
    //             {
    //               "from": 12,
    //               "to": 15
    //             },
    //             {
    //               "from": 15,
    //               "to": 18
    //             },
    //             {
    //               "from": 18,
    //               "to": 21
    //             }],
    //           "\u0633\u0647\u200c\u0634\u0646\u0628\u0647": [{
    //             "from": 9,
    //             "to": 12
    //           },
    //             {
    //               "from": 12,
    //               "to": 15
    //             },
    //             {
    //               "from": 15,
    //               "to": 18
    //             },
    //             {
    //               "from": 18,
    //               "to": 21
    //             }],
    //           "\u0686\u0647\u0627\u0631\u200c\u0634\u0646\u0628\u0647": [{
    //             "from": 9,
    //             "to": 12
    //           },
    //             {
    //               "from": 12,
    //               "to": 15
    //             },
    //             {
    //               "from": 15,
    //               "to": 18
    //             },
    //             {
    //               "from": 18,
    //               "to": 21
    //             }],
    //           "\u067e\u0646\u062c\u200c\u0634\u0646\u0628\u0647": [{
    //             "from": 9,
    //             "to": 12
    //           },
    //             {
    //               "from": 12,
    //               "to": 15
    //             },
    //             {
    //               "from": 15,
    //               "to": 18
    //             },
    //             {
    //               "from": 18,
    //               "to": 21
    //             }],
    //           "\u062c\u0645\u0639\u0647": [{
    //             "from": 9,
    //             "to": 12
    //           },
    //             {
    //               "from": 12,
    //               "to": 15
    //             },
    //             {
    //               "from": 15,
    //               "to": 18
    //             },
    //             {
    //               "from": 18,
    //               "to": 21
    //             }]
    //         },
    //         "full_time_windows": []
    //       }]
    //   }
    // };
    // var userHasFastShippingPurchaseHistory = true;
    // var nonInteraction = false;
    // var isPlusUser = false;
    // var skipItemIds = [1130176984, 1130270410, 1130270411, 1130489950];
    var dataLayerData = null;
    var faqPageTitle = "shipping_section";
    var userId = {{ $customer->id }};
    // var adroRCActivation = true;
    var loginRegisterUrlWithBack = "";
    var isNewCustomer = false;
  </script>


  <script src="{{ asset('assets/js/sentry.js') }}"></script>
  <script src="{{ asset('assets/js/address.js') }}"></script>
  <script src="{{ asset('assets/js/map-second.js') }}"></script>
  <script src="https://www.parsimap.com/js/v3.1.0/parsimap.js?key=public"></script>
</head>

<body class=" t-header-light c-checkout-pages" style="">

<style>
  @media screen and (-ms-high-contrast: none) {
    .c-shipment-page__to-payment-sticky, .c-checkout__to-shipping-sticky {
      position: relative !important;
    }

    .c-checkout-aside {
      position: relative !important;
    }
  }

  /* all edge versions */
  @supports (-ms-ime-align:auto) {
    .c-shipment-page__to-payment-sticky, .c-checkout__to-shipping-sticky {
      position: relative !important;
    }

    .c-checkout-aside {
      position: relative !important;
    }
  }
</style>

<header class="c-header js-header">
  <div class="container">
    <div class="c-header__row js-header-sticky">
      <div class="c-header__right-side">
        <div class="c-header__logo ">
          <a data-snt-event="dkHeaderClick" data-snt-params='{"item":"digikala-logo","item_option":null}'
             href="/?ref=nav_logo" class="c-header__logo-img">Digikala</a>
        </div>
        <div class="c-header__search">
          <div class="c-search js-search" data-event="using_search_box" data-event-category="header_section">
            <span class="c-search__reset u-hidden js-search-reset"></span>
            <input type="text" name="q" placeholder="جستجو در {{ $fa_store_name }} …" class="js-search-input"
                   autocomplete="off" value="">
            <div class="c-search__results js-search-results">
              <div
                class="js-ab-search-box-product-suggestions swiper-container swiper-container-horizontal js-swiper-product-suggestions c-search__product-suggestions-list-container">
                <ul class="js-product-suggestions-list swiper-wrapper"></ul>
                <div class="js-swiper-button-prev swiper-butsston-prev c-search__swiper-button-prev-circle"></div>
                <div class="js-swiper-button-next swiper-buttossn-next c-search__swiper-button-next-circle"></div>
              </div>
              <ul class="c-search__results-last-searches-container js-last-searches">
                <div class="c-search__label-container">
                  <span class="c-search__searches-label-icon c-search__searches-label-icon--last-searches"></span>
                  <span class="c-search__searches-label">تاریخچه جستجوهای شما</span>
                  <span class="c-search__last-searches-trash-icon js-last-searches-trash-icon"></span>
                </div>
                <div class="c-search__results-last-searches-items js-last-searches-items"></div>
              </ul>
              <div>
                <div class="c-search__label-container">
                  <span class="c-search__searches-label-icon c-search__searches-label-icon--trend"></span>
                  <span class="c-search__searches-label">بیشترین جستجوهای اخیر</span>
                </div>
                <ul class="c-search__results-trends js-trends-results"></ul>
              </div>
              <ul class="js-autosuggest-results-list c-search__results-list c-search__results-list--autosuggest"></ul>
              <ul class="js-results-list c-search__results-list"></ul>
              <ul class="js-autosuggest-empty-list c-search__results-list">
                <li>
                  <a class="js-search-keyword-link" href="javascript:">
                    <span class="c-search__result-item c-search__result-icon c-search__result-icon--group">نمایش همه نتایج برای </span>
                    <span class="c-search__result-item--category js-search-keyword"></span>
                  </a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
      <div class=" c-header__action">
        <div class="c-header__btn-container">
          <input type="hidden" id="topBarMeta" data-cart_count='4'
                 data-cart_items='[{"item":1977404,"quantity":1,"price":1480000},{"item":2217851,"quantity":1,"price":667640000},{"item":4826524,"quantity":1,"price":415000},{"item":4142175,"quantity":1,"price":400000}]'/>
          <input type="hidden" id="ESILogged" data-logged=1 data-user_id=9735394 data-email="mehdi.jalaliii03@gmail.com"
                 data-default_phone="{{ 0 . $customer->mobile }}" data-login_phone="{{ 0 . $customer->mobile }}"
                 data-mobile_phone="{{ 0 . $customer->mobile }}"
                 data-first_name="مهدی" data-last_name="جلالی"/>
          <div class="c-header__btn-user-container c-header__btn-profile-container js-dropdown-container">
            <a data-snt-event="dkHeaderClick" data-snt-params='{"item":"account","item_option":null}'
               class="c-header__btn-profile js-dropdown-toggle">
            </a>
            <div class="c-header__profile-dropdown js-dropdown-menu">
              <div class="c-header__profile-dropdown-account-container">
                <div class="c-header__profile-dropdown-user">
                  <div class="c-header__profile-dropdown-user-img">
                    <img src="https://www.digikala.com/static/files/fd4840b2.svg"/>
                  </div>
                  <div class="c-header__profile-dropdown-user-info">
                    <p
                      class="c-header__profile-dropdown-user-name">{{ $customer->first_name . ' ' . $customer->last_name }}</p>
                    <span class="c-header__profile-dropdown-user-profile-link">مشاهده حساب کاربری</span>
                  </div>
                </div>
                <a href="/profile/" data-snt-event="dkHeaderClick"
                   data-snt-params='{"item":"account","item_option":"profile"}' data-event="profile_click"
                   data-event-category="header_section" data-event-label="logged_in: True - digiclub_score: 87000"
                   class="c-header__profile-dropdown-user-profile-full-link"></a>
              </div>
              <div class="c-header__profile-dropdown-actions">
                <div class="c-header__profile-dropdown-action-container">
                  <a href="/profile/my-orders/" data-snt-event="dkHeaderClick"
                     data-snt-params='{"item":"account","item_option":"orders"}'
                     class="c-header__profile-dropdown-action c-header__profile-dropdown-action--orders ">سفارش‌های
                    من</a>
                </div>
                <div class="c-header__profile-dropdown-action-container u-hidden">
                  <a href="/profile/favorites/?convert=true"
                     class="c-header__profile-dropdown-action c-header__profile-dropdown-action--favorites">
                    لیست مورد علاقه
                  </a>
                </div>
                <div class="c-header__profile-dropdown-action-container">
                  <a href="{{ route('customer.forgotPage') }}" data-snt-event="dkHeaderClick"
                     data-snt-params='{"item":"account","item_option":"sign-out"}'
                     class="c-header__profile-dropdown-action c-header__profile-dropdown-action--logout js-logout-button">خروج
                    از حساب کاربری</a>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div id="mini-cart" class="c-header__btn-container">
          <div class="c-header__btn-cart-container js-mini-cart-container">
            <a id="cart-button" class="c-header__btn-cart " data-snt-event="dkHeaderClick"
               data-snt-params='{"item":"mini-cart","item_option":null}' data-counter="۴" href="/cart/"
               data-event="mini_cart_click" data-event-category="header_section"
               data-event-label="items: 4 - total price: 669935000">
              <span class="js-cart-count c-header__btn-cart-counter c-header__btn-cart-counter--square"
                    data-counter="۴">۴</span>
            </a>
            <div class="c-header__cart-info js-mini-cart-dropdown">
              <div class="c-header__cart-info-header">
                <div class="c-header__cart-info-count">
                  ۴ کالا
                </div>
                <a data-snt-event="dkHeaderClick" data-snt-params='{"item":"mini-cart","item_option":"cart-page"}'
                   href="/cart/" class="c-header__cart-info-link">
                  <span>مشاهده سبد خرید</span>
                </a>
              </div>
              <ul class="c-header__basket-list">
                <li class="js-mini-cart-item" data-is-fresh="1">
                  <a data-snt-event="dkHeaderClick" data-snt-params='{"item":"mini-cart","item_option":"cart-item"}'
                     href="/product/dkp-1977404/روغن-کنجد-کانولا-و-آفتابگردان-سرخ-کردنی-داتیس-18-لیتر"
                     class="c-header__basket-list-item">
                    <div class="c-header__basket-list-item-image">
                      <img alt="روغن کنجد، کانولا و آفتابگردان سرخ کردنی داتیس - 1.8 لیتر"
                           src="https://dkstatics-public.digikala.com/digikala-products/113104125.jpg?x-oss-process=image/resize,m_lfit,h_150,w_150/quality,q_80"/>
                    </div>
                    <div class="c-header__basket-list-item-content">
                      <p class="c-header__basket-list-item-title">روغن کنجد، کانولا و آفتابگردان سرخ کردنی داتیس - 1.8
                        لیتر</p>
                      <p>
                        <span
                          class="c-header__basket-list-item-shipping-type c-header__basket-list-item-shipping-type--fresh">ارسال سریع</span>
                      </p>
                      <div class="c-header__basket-list-item-footer">
                        <div class="c-header__basket-list-item-props">
                          <span class="c-header__basket-list-item-props-item"> ۱ عدد</span>
                        </div>
                        <button class="c-header__basket-list-item-remove js-mini-cart-remove-item"
                                data-snt-event="dkHeaderClick"
                                data-snt-params='{"item":"mini-cart","item_option":"remove-item"}' data-id="1130176984"
                                data-product="1977404" data-variant="5904180" data-enhanced-ecommerce='null'></button>
                      </div>
                    </div>
                  </a>
                </li>
                <li class="js-mini-cart-item" data-is-fresh="">
                  <a data-snt-event="dkHeaderClick" data-snt-params='{"item":"mini-cart","item_option":"cart-item"}'
                     href="/product/dkp-2217851/لپ-تاپ-16-اینچی-اپل-مدل-macbook-pro-mvvm2-2019-همراه-با-تاچ-بار"
                     class="c-header__basket-list-item">
                    <div class="c-header__basket-list-item-image">
                      <img alt="لپ تاپ 16 اینچی اپل مدل MacBook Pro MVVM2 2019 همراه با تاچ بار"
                           src="https://dkstatics-public.digikala.com/digikala-products/114391682.jpg?x-oss-process=image/resize,m_lfit,h_150,w_150/quality,q_80"/>
                    </div>
                    <div class="c-header__basket-list-item-content">
                      <p class="c-header__basket-list-item-title">لپ تاپ 16 اینچی اپل مدل MacBook Pro MVVM2 2019 همراه
                        با تاچ بار</p>
                      <p>
                        <span
                          class="c-header__basket-list-item-shipping-type c-header__basket-list-item-shipping-type--not-ready">
                          تامین کالا از
                          ۱
                          روز کاری آینده
                        </span>
                      </p>
                      <div class="c-header__basket-list-item-footer">
                        <div class="c-header__basket-list-item-props">
                          <span class="c-header__basket-list-item-props-item"> ۱ عدد</span>
                          <span class="c-header__basket-list-item-props-item">
                              <div class="c-header__basket-list-item-color-badge" style="background: #dedede"></div>
                              نقره ای
                          </span>
                        </div>
                        <button class="c-header__basket-list-item-remove js-mini-cart-remove-item"
                                data-snt-event="dkHeaderClick"
                                data-snt-params='{"item":"mini-cart","item_option":"remove-item"}' data-id="1130270410"
                                data-product="2217851" data-variant="9449846" data-enhanced-ecommerce='null'></button>
                      </div>
                    </div>
                  </a>
                </li>
                <li class="js-mini-cart-item" data-is-fresh="">
                  <a data-snt-event="dkHeaderClick" data-snt-params='{"item":"mini-cart","item_option":"cart-item"}'
                     href="/product/dkp-4826524/درزگیر-ترک-سطوح-نیپون-مدل-s100-وزن-1-کیلوگرم"
                     class="c-header__basket-list-item">
                    <div class="c-header__basket-list-item-image">
                      <img alt="درزگیر ترک سطوح نیپون مدل S100 وزن 1 کیلوگرم"
                           src="https://dkstatics-public.digikala.com/digikala-products/6cae8819a71e3d41e56612c0de87cd2c5ad293ff_1617526029.jpg?x-oss-process=image/resize,m_lfit,h_150,w_150/quality,q_80"/>
                    </div>
                    <div class="c-header__basket-list-item-content">
                      <p class="c-header__basket-list-item-title">درزگیر ترک سطوح نیپون مدل S100 وزن 1 کیلوگرم</p>
                      <p>
                        <span
                          class="c-header__basket-list-item-shipping-type c-header__basket-list-item-shipping-type--not-ready">
                        تامین کالا از
                        ۴
                        روز کاری آینده
                        </span>
                      </p>
                      <div class="c-header__basket-list-item-footer">
                        <div class="c-header__basket-list-item-props">
                          <span class="c-header__basket-list-item-props-item"> ۱ عدد</span>
                        </div>
                        <button class="c-header__basket-list-item-remove js-mini-cart-remove-item"
                                data-snt-event="dkHeaderClick"
                                data-snt-params='{"item":"mini-cart","item_option":"remove-item"}' data-id="1130270411"
                                data-product="4826524" data-variant="15477082" data-enhanced-ecommerce='null'></button>
                      </div>
                    </div>
                  </a>
                </li>
                <li class="js-mini-cart-item" data-is-fresh="">
                  <a data-snt-event="dkHeaderClick" data-snt-params='{"item":"mini-cart","item_option":"cart-item"}'
                     href="/product/dkp-4142175/ماسک-تنفسی-دکتر-کرست-مدل-dr-g40-بسته-40-عددی"
                     class="c-header__basket-list-item">
                    <div class="c-header__basket-list-item-image">
                      <img alt="ماسک تنفسی دکتر کرست مدل Dr-G40 بسته 40 عددی"
                           src="https://dkstatics-public.digikala.com/digikala-products/b98c526cde5163111c2236e94ece33d2bf827ca5_1609580174.jpg?x-oss-process=image/resize,m_lfit,h_150,w_150/quality,q_80"/>
                    </div>
                    <div class="c-header__basket-list-item-content">
                      <p class="c-header__basket-list-item-title">ماسک تنفسی دکتر کرست مدل Dr-G40 بسته 40 عددی</p>
                      <p>
                        <span
                          class="c-header__basket-list-item-shipping-type c-header__basket-list-item-shipping-type--not-ready">
                        تامین کالا از
                        ۱
                        روز کاری آینده
                        </span>
                      </p>
                      <div class="c-header__basket-list-item-footer">
                        <div class="c-header__basket-list-item-props">
                          <span class="c-header__basket-list-item-props-item"> ۱ عدد</span>
                        </div>
                        <button class="c-header__basket-list-item-remove js-mini-cart-remove-item"
                                data-snt-event="dkHeaderClick"
                                data-snt-params='{"item":"mini-cart","item_option":"remove-item"}' data-id="1130489950"
                                data-product="4142175" data-variant="13431464" data-enhanced-ecommerce='null'></button>
                      </div>
                    </div>
                  </a>
                </li>
              </ul>
              <div class="c-header__cart-info-footer">
                <div class="c-header__cart-info-total">
                  <span class="c-header__cart-info-total-text">مبلغ قابل پرداخت</span>
                  <p class="c-header__cart-info-total-amount">
                    <span class="c-header__cart-info-total-amount-number"> ۶۶,۹۹۳,۵۰۰</span>
                    <span> تومان</span>
                  </p>
                </div>
                <div>
                  <a data-snt-event="dkHeaderClick" data-snt-params='{"item":"mini-cart","item_option":"confirm-cart"}'
                     href="/shipping/" class="c-header__cart-info-submit c-header__cart-info-submit--red">ثبت سفارش</a>
                </div>
              </div>
            </div>
          </div>
          <div class="remodal c-modal c-u-minicart__modal u-hidden js-minicart-modal"
               data-remodal-id="universal-mini-cart" role="dialog" aria-labelledby="modalTitle" tabindex="-1z"
               aria-describedby="modalDesc" data-remodal-options="">
            <div class="c-modal__top-bar  ">
              <div>
                <div class="c-u-minicart__quantity">
                  سبد خرید
                  <span>۴ کالا</span>
                </div>
                <a href="/cart/" class="o-link o-link--has-arrow o-link--no-border o-link--sm">مشاهده سبد خرید</a>
              </div>
              <div class="c-modal__close" data-remodal-action="close"></div>
            </div>
            <div class="c-u-minicart">
              <div class="c-cart-item" data-price-change="" data-min-price-badge="">
                <div class="c-cart-item__thumb">
                  <a class="c-cart-item__thumb-img" href="" target="_blank">
                    <img alt="روغن کنجد، کانولا و آفتابگردان سرخ کردنی داتیس - 1.8 لیتر"
                         src="https://dkstatics-public.digikala.com/digikala-products/113104125.jpg?x-oss-process=image/resize,m_lfit,h_150,w_150/quality,q_80">
                  </a>
                  <div class="c-cart-item__price-row">
                    <div class="c-cart-item__quantity-row">
                      <div class="c-quantity-selector">
                        <button type="button" class="c-quantity-selector__add js-minicart-add"></button>
                        <div class="c-quantity-selector__number js-minicart-count" data-id="5904180">
                          ۱
                        </div>
                        <button type="button"
                                class="c-quantity-selector__remove u-hidden c-quantity-selector__add--disabled js-minicart-remove"></button>
                        <button type="button" class="c-quantity-selector__trash js-mini-cart-remove-item "
                                data-id="1130176984" data-product="1977404" data-variant="5904180"
                                data-enhanced-ecommerce='null'></button>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="c-cart-item__data">
                  <div class="c-cart-item__title">
                    روغن کنجد، کانولا و آفتابگردان سرخ کردنی داتیس - 1.8 لیتر
                  </div>
                  <div class="c-cart-item__product-data c-cart-item__product-data--seller">
                    {{ $fa_store_name }}
                  </div>
                  <div class="c-cart-item__product-data c-cart-item__product-data--lead-time">
                    موجود در انبار {{ $fa_store_name }}
                    <span class="c-cart-item__product-sender-row"></span>
                  </div>
                  <div class="c-cart-item__spacer"></div>
                  <div class="c-cart-item__product-price">
                    ۱۴۸,۰۰۰
                  </div>
                </div>
              </div>
              <div class="c-cart-item" data-price-change="" data-min-price-badge="">
                <div class="c-cart-item__thumb">
                  <a class="c-cart-item__thumb-img" href="" target="_blank">
                    <img alt="لپ تاپ 16 اینچی اپل مدل MacBook Pro MVVM2 2019 همراه با تاچ بار"
                         src="https://dkstatics-public.digikala.com/digikala-products/114391682.jpg?x-oss-process=image/resize,m_lfit,h_150,w_150/quality,q_80">
                  </a>
                  <div class="c-cart-item__price-row">
                    <div class="c-cart-item__quantity-row">
                      <div class="c-quantity-selector">
                        <button type="button" class="c-quantity-selector__add js-minicart-add">
                        </button>
                        <div class="c-quantity-selector__number js-minicart-count" data-id="9449846">
                          ۱
                        </div>
                        <button type="button"
                                class="c-quantity-selector__remove u-hidden c-quantity-selector__add--disabled js-minicart-remove"></button>
                        <button type="button" class="c-quantity-selector__trash js-mini-cart-remove-item "
                                data-id="1130270410" data-product="2217851" data-variant="9449846"
                                data-enhanced-ecommerce='null'></button>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="c-cart-item__data">
                  <div class="c-cart-item__title">
                    لپ تاپ 16 اینچی اپل مدل MacBook Pro MVVM2 2019 همراه با تاچ بار
                  </div>
                  <div class="c-cart-item__product-data c-cart-item__product-data--color">
                    <span style="background-color:#dedede;"></span>
                    نقره ای
                  </div>
                  <div class="c-cart-item__product-data c-cart-item__product-data--seller">
                    رایان مال
                  </div>
                  <div class="c-cart-item__product-data c-cart-item__product-data--lead-time">
                    موجود در انبار فروشنده
                    <span class="c-cart-item__product-sender-row"></span>
                  </div>
                  <div class="c-cart-item__spacer"></div>
                  <div class="c-cart-item__product-price">
                    ۶۶,۷۶۴,۰۰۰
                  </div>
                </div>
              </div>
              <div class="c-cart-item" data-price-change="" data-min-price-badge="">
                <div class="c-cart-item__thumb">
                  <a class="c-cart-item__thumb-img" href="" target="_blank">
                    <img alt="درزگیر ترک سطوح نیپون مدل S100 وزن 1 کیلوگرم"
                         src="https://dkstatics-public.digikala.com/digikala-products/6cae8819a71e3d41e56612c0de87cd2c5ad293ff_1617526029.jpg?x-oss-process=image/resize,m_lfit,h_150,w_150/quality,q_80">
                  </a>
                  <div class="c-cart-item__price-row">
                    <div class="c-cart-item__quantity-row">
                      <div class="c-quantity-selector">
                        <button type="button" class="c-quantity-selector__add js-minicart-add"></button>
                        <div class="c-quantity-selector__number js-minicart-count" data-id="15477082">
                          ۱
                        </div>
                        <button type="button"
                                class="c-quantity-selector__remove u-hidden c-quantity-selector__add--disabled js-minicart-remove"></button>
                        <button type="button" class="c-quantity-selector__trash js-mini-cart-remove-item "
                                data-id="1130270411" data-product="4826524" data-variant="15477082"
                                data-enhanced-ecommerce='null'></button>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="c-cart-item__data">
                  <div class="c-cart-item__title">
                    درزگیر ترک سطوح نیپون مدل S100 وزن 1 کیلوگرم
                  </div>
                  <div class="c-cart-item__product-data c-cart-item__product-data--seller">
                    رنگ نیپون
                  </div>
                  <div class="c-cart-item__product-data c-cart-item__product-data--lead-time">
                    موجود در انبار فروشنده
                    <span class="c-cart-item__product-sender-row"></span>
                  </div>
                  <div class="c-cart-item__spacer"></div>
                  <div class="c-cart-item__product-price">
                    ۴۱,۵۰۰
                  </div>
                </div>
              </div>
              <div class="c-cart-item" data-price-change="" data-min-price-badge="">
                <div class="c-cart-item__thumb">
                  <a class="c-cart-item__thumb-img" href="" target="_blank">
                    <img alt="ماسک تنفسی دکتر کرست مدل Dr-G40 بسته 40 عددی"
                         src="https://dkstatics-public.digikala.com/digikala-products/b98c526cde5163111c2236e94ece33d2bf827ca5_1609580174.jpg?x-oss-process=image/resize,m_lfit,h_150,w_150/quality,q_80">
                  </a>
                  <div class="c-cart-item__price-row">
                    <div class="c-cart-item__quantity-row">
                      <div class="c-quantity-selector">
                        <button type="button" class="c-quantity-selector__add js-minicart-add"></button>
                        <div class="c-quantity-selector__number js-minicart-count" data-id="13431464">
                          ۱
                        </div>
                        <button type="button"
                                class="c-quantity-selector__remove u-hidden c-quantity-selector__add--disabled js-minicart-remove"></button>
                        <button type="button" class="c-quantity-selector__trash js-mini-cart-remove-item "
                                data-id="1130489950" data-product="4142175" data-variant="13431464"
                                data-enhanced-ecommerce='null'></button>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="c-cart-item__data">
                  <div class="c-cart-item__title">
                    ماسک تنفسی دکتر کرست مدل Dr-G40 بسته 40 عددی
                  </div>
                  <div class="c-cart-item__product-data c-cart-item__product-data--seller">
                    بازرگانی جوی مارکت
                  </div>
                  <div
                    class="c-cart-item__product-data
                                    c-cart-item__product-data--lead-time">
                    موجود در انبار فروشنده
                    <span class="c-cart-item__product-sender-row">
                                    </span>
                  </div>
                  <div class="c-cart-item__spacer"></div>
                  <div class="c-cart-item__product-price">
                    ۴۰,۰۰۰
                  </div>
                </div>
              </div>
            </div>
            <div class="c-modal__footer">
              <div class="c-header__cart-info-total">
                <span class="c-header__cart-info-total-text">مبلغ قابل پرداخت</span>
                <p class="c-header__cart-info-total-amount">
                  <span class="c-header__cart-info-total-amount-number"> ۶۶,۹۹۳,۵۰۰</span>
                  <span> تومان</span>
                </p>
              </div>
              <div>
                <a data-snt-event="dkHeaderClick" data-snt-params='{"item":"mini-cart","item_option":"confirm-cart"}'
                   href="/shipping/" class="o-btn o-btn--contained-red-md">ثبت سفارش</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <nav class="c-navi js-navi">
    <div class="container">
      <div class="c-navi__row">
        <ul class="c-navi-new-list">
          <li class="c-navi-new-list__categories">
            <ul class="c-navi-new-list__category-item">
              <li class="c-navi-new-list__a-hover js-navi-new-list-category-hover">
                <div></div>
              </li>
              <li
                class="js-categories-bar-item js-mega-menu-main-item js-categories-item c-navi-new-list__category-container-main">
                <div class="c-navi-new-list__category c-navi-new-list__category--main">دسته‌بندی کالاها</div>
                <div class="c-navi-new-list__sublist js-mega-menu-categories-options c-navi-new__ads-holder">
                  <div class="c-navi-new-list__inner-categories">
                    <a href="/main/electronic-devices/"
                       class="c-navi-new-list__inner-category c-navi-new-list__inner-category--hovered js-mega-menu-category c-navi-new-list__inner-category--electronics"
                       data-index="1">کالای دیجیتال</a>
                    <a href="/main/vehicles/"
                       class="c-navi-new-list__inner-category  js-mega-menu-category c-navi-new-list__inner-category--tools"
                       data-index="2">خودرو، ابزار و تجهیزات صنعتی</a>
                    <a href="/main/apparel/"
                       class="c-navi-new-list__inner-category  js-mega-menu-category c-navi-new-list__inner-category--fashion"
                       data-index="3">مد و پوشاک</a>
                    <a href="/main/mother-and-child/"
                       class="c-navi-new-list__inner-category  js-mega-menu-category c-navi-new-list__inner-category--mother-and-child"
                       data-index="4">اسباب بازی، کودک و نوزاد</a>
                    <a href="/main/food-beverage/"
                       class="c-navi-new-list__inner-category  js-mega-menu-category c-navi-new-list__inner-category--food-and-beverage"
                       data-index="5">کالاهای سوپرمارکتی</a>
                    <a href="/main/personal-appliance/"
                       class="c-navi-new-list__inner-category  js-mega-menu-category c-navi-new-list__inner-category--personal-appliance"
                       data-index="6">زیبایی و سلامت</a>
                    <a href="/main/home-and-kitchen/"
                       class="c-navi-new-list__inner-category  js-mega-menu-category c-navi-new-list__inner-category--home-and-kitchen"
                       data-index="7">خانه و آشپزخانه</a>
                    <a href="/main/book-and-media/"
                       class="c-navi-new-list__inner-category  js-mega-menu-category c-navi-new-list__inner-category--book-and-media"
                       data-index="8">کتاب، لوازم تحریر و هنر</a>
                    <a href="/main/sport-entertainment/"
                       class="c-navi-new-list__inner-category  js-mega-menu-category c-navi-new-list__inner-category--sport-and-entertainment"
                       data-index="9">ورزش و سفر</a></div>
                  <div class="c-navi-new-list__options-container">
                    <div class="c-navi-new-list__options-list is-active js-mega-menu-category-options"
                         id="categories-1">
                      <div class="c-navi-new-list__sublist-top-bar">
                        <a href="/main/electronic-devices/" class="c-navi-new-list__sublist-see-all-cats">
                          همه دسته‌بندی‌های کالای دیجیتال
                        </a>
                      </div>
                      <ul>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--title"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en: mobile - category_fa: لوازم جانبی گوشی - level: 2">
                          <a data-snt-event="dkMegaMenuClick"
                             data-snt-params='{"type":"option-title","category_title":"لوازم جانبی گوشی"}'
                             href="/search/category-mobile-accessories/" class=" c-navi-new__big-display-title">
                            <span>لوازم جانبی گوشی</span>
                          </a>
                          <a data-snt-event="dkMegaMenuClick"
                             data-snt-params='{"type":"option-title","category_title":"لوازم جانبی گوشی"}'
                             href="/search/category-mobile-accessories/" class=" c-navi-new__medium-display-title">
                            <span>لوازم جانبی گوشی</span>
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en: cell phone pouch cover - category_fa: کیف و کاور گوشی - level: 3">
                          <a data-snt-event="dkMegaMenuClick"
                             data-snt-params='{"type":"option-item","category_title":"کیف و کاور گوشی"}'
                             href="/search/category-cell-phone-pouch-cover/" class=" c-navi-new__big-display-title">
                            کیف و کاور گوشی
                          </a>
                          <a data-snt-event="dkMegaMenuClick"
                             data-snt-params='{"type":"option-item","category_title":"کیف و کاور گوشی"}'
                             href="/search/category-cell-phone-pouch-cover/" class=" c-navi-new__medium-display-title">
                            کیف و کاور گوشی
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: پاور بانک (شارژر همراه) - level: 3">
                          <a data-snt-event="dkMegaMenuClick"
                             data-snt-params='{"type":"option-item","category_title":"پاور بانک (شارژر همراه)"}'
                             href="/search/category-power-bank/" class=" c-navi-new__big-display-title">
                            پاور بانک (شارژر همراه)
                          </a>
                          <a data-snt-event="dkMegaMenuClick"
                             data-snt-params='{"type":"option-item","category_title":"پاور بانک (شارژر همراه)"}'
                             href="/search/category-power-bank/" class=" c-navi-new__medium-display-title">
                            پاور بانک (شارژر همراه)
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: پایه نگهدارنده گوشی - level: 3">
                          <a data-snt-event="dkMegaMenuClick"
                             data-snt-params='{"type":"option-item","category_title":"پایه نگهدارنده گوشی"}'
                             href="/search/category-cell-phone-holder/" class=" c-navi-new__big-display-title">
                            پایه نگهدارنده گوشی
                          </a>
                          <a data-snt-event="dkMegaMenuClick"
                             data-snt-params='{"type":"option-item","category_title":"پایه نگهدارنده گوشی"}'
                             href="/search/category-cell-phone-holder/" class=" c-navi-new__medium-display-title">
                            پایه نگهدارنده گوشی
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--title"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en: mobile phone - category_fa: گوشی موبایل - level: 2">
                          <a data-snt-event="dkMegaMenuClick"
                             data-snt-params='{"type":"option-title","category_title":"گوشی موبایل"}'
                             href="/search/category-mobile-phone/" class=" c-navi-new__big-display-title">
                            <span>گوشی موبایل</span>
                          </a>
                          <a data-snt-event="dkMegaMenuClick"
                             data-snt-params='{"type":"option-title","category_title":"گوشی موبایل"}'
                             href="/search/category-mobile-phone/" class=" c-navi-new__medium-display-title">
                            <span>گوشی موبایل</span>
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en: Samsung - category_fa: سامسونگ - level: 3">
                          <a data-snt-event="dkMegaMenuClick"
                             data-snt-params='{"type":"option-item","category_title":"سامسونگ"}'
                             href="https://www.digikala.com/search/category-mobile-phone/?q=سامسونگ&entry=mm"
                             class=" c-navi-new__big-display-title">
                            سامسونگ
                          </a>
                          <a data-snt-event="dkMegaMenuClick"
                             data-snt-params='{"type":"option-item","category_title":"سامسونگ"}'
                             href="https://www.digikala.com/search/category-mobile-phone/?q=سامسونگ&entry=mm"
                             class=" c-navi-new__medium-display-title">
                            سامسونگ
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: هوآوی - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"هوآوی"}'
                            href="/search/category-mobile-phone/?q=%d9%87%d9%88%d8%a7%d9%88%db%8c&entry=mm"
                            class=" c-navi-new__big-display-title">
                            هوآوی
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"هوآوی"}'
                                 href="/search/category-mobile-phone/?q=%d9%87%d9%88%d8%a7%d9%88%db%8c&entry=mm"
                                 class=" c-navi-new__medium-display-title">
                            هوآوی
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en: Apple iPhone - category_fa: اپل - level: 3">
                          <a data-snt-event="dkMegaMenuClick"
                             data-snt-params='{"type":"option-item","category_title":"اپل"}'
                             href="/search/category-mobile-phone/?q=%d8%a7%d9%be%d9%84&entry=mm"
                             class=" c-navi-new__big-display-title">
                            اپل
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"اپل"}'
                                 href="/search/category-mobile-phone/?q=%d8%a7%d9%be%d9%84&entry=mm"
                                 class=" c-navi-new__medium-display-title">
                            اپل
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en: Xiaomi - category_fa: شیائومی - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"شیائومی"}'
                            href="https://www.digikala.com/search/category-mobile-phone/?q=شیائومی&entry=mm"
                            class=" c-navi-new__big-display-title">
                            شیائومی
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"شیائومی"}'
                                 href="https://www.digikala.com/search/category-mobile-phone/?q=شیائومی&entry=mm"
                                 class=" c-navi-new__medium-display-title">
                            شیائومی
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en: Honor - category_fa: آنر - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"آنر"}'
                            href="https://www.digikala.com/search/category-mobile-phone/?q=آنر&entry=mm"
                            class=" c-navi-new__big-display-title">
                            آنر
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"آنر"}'
                                 href="https://www.digikala.com/search/category-mobile-phone/?q=آنر&entry=mm"
                                 class=" c-navi-new__medium-display-title">
                            آنر
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en: Nokia - category_fa: نوکیا - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"نوکیا"}'
                            href="https://www.digikala.com/search/category-mobile-phone/?q=نوکیا&entry=mm"
                            class=" c-navi-new__big-display-title">
                            نوکیا
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"نوکیا"}'
                                 href="https://www.digikala.com/search/category-mobile-phone/?q=نوکیا&entry=mm"
                                 class=" c-navi-new__medium-display-title">
                            نوکیا
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--title"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: واقعیت مجازی - level: 2"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"واقعیت مجازی"}'
                            href="/search/category-mobile-accessories/?q=%d9%87%d8%af%d8%b3%d8%aa%20%d9%88%d8%a7%d9%82%d8%b9%db%8c%d8%aa%20%d9%85%d8%ac%d8%a7%d8%b2%db%8c&entry=mm"
                            class=" c-navi-new__big-display-title"><span>واقعیت مجازی</span></a><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"واقعیت مجازی"}'
                            href="/search/category-mobile-accessories/?q=%d9%87%d8%af%d8%b3%d8%aa%20%d9%88%d8%a7%d9%82%d8%b9%db%8c%d8%aa%20%d9%85%d8%ac%d8%a7%d8%b2%db%8c&entry=mm"
                            class=" c-navi-new__medium-display-title"><span>واقعیت مجازی</span></a></li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--title"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: مچ‌بند و ساعت هوشمند - level: 2"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"مچ‌بند و ساعت هوشمند"}'
                            href="/search/category-wearable-gadget/" class=" c-navi-new__big-display-title"><span>مچ‌بند و ساعت هوشمند</span></a><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"مچ‌بند و ساعت هوشمند"}'
                            href="/search/category-wearable-gadget/" class=" c-navi-new__medium-display-title"><span>مچ‌بند و ساعت هوشمند</span></a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--title"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: هدفون، هدست، هندزفری - level: 2"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"هدفون، هدست، هندزفری"}'
                            href="/search/category-headphone-headset-microphone/"
                            class=" c-navi-new__big-display-title"><span>هدفون، هدست، هندزفری</span></a><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"هدفون، هدست، هندزفری"}'
                            href="/search/category-headphone-headset-microphone/"
                            class=" c-navi-new__medium-display-title"><span>هدفون، هدست، هندزفری</span></a></li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--title"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: اسپیکر بلوتوث و با سیم - level: 2"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"اسپیکر بلوتوث و با سیم"}'
                            href="/search/category-speaker/" class=" c-navi-new__big-display-title"><span>اسپیکر بلوتوث و با سیم</span></a><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"اسپیکر بلوتوث و با سیم"}'
                            href="/search/category-speaker/" class=" c-navi-new__medium-display-title"><span>اسپیکر بلوتوث و با سیم</span></a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--title"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: هارد، فلش و SSD - level: 2"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"هارد، فلش و SSD"}'
                            href="/search/category-data-storage/" class=" c-navi-new__big-display-title"><span>هارد، فلش و SSD</span></a><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"هارد، فلش و SSD"}'
                            href="/search/category-data-storage/" class=" c-navi-new__medium-display-title"><span>هارد، فلش و SSD</span></a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--title"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: دوربین - level: 2"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"دوربین"}'
                            href="/search/category-camera/"
                            class=" c-navi-new__big-display-title"><span>دوربین</span></a><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"دوربین"}'
                            href="/search/category-camera/"
                            class=" c-navi-new__medium-display-title"><span>دوربین</span></a></li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: دوربین عکاسی دیجیتال - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"دوربین عکاسی دیجیتال"}'
                            href="/search/category-digital-camera/" class=" c-navi-new__big-display-title">
                            دوربین عکاسی دیجیتال
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"دوربین عکاسی دیجیتال"}'
                                 href="/search/category-digital-camera/" class=" c-navi-new__medium-display-title">
                            دوربین عکاسی دیجیتال
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: دوربین‌ ورزشی و فیلم برداری - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"دوربین‌ ورزشی و فیلم برداری"}'
                            href="/search/category-camcorder/" class=" c-navi-new__big-display-title">
                            دوربین‌ ورزشی و فیلم برداری
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"دوربین‌ ورزشی و فیلم برداری"}'
                                 href="/search/category-camcorder/" class=" c-navi-new__medium-display-title">
                            دوربین‌ ورزشی و فیلم برداری
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: دوربین‌ چاپ سریع - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"دوربین‌ چاپ سریع"}'
                            href="/search/category-digital-camera/?q=%da%86%d8%a7%d9%be%20%d8%b3%d8%b1%db%8c%d8%b9&entry=mm"
                            class=" c-navi-new__big-display-title">
                            دوربین‌ چاپ سریع
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"دوربین‌ چاپ سریع"}'
                                 href="/search/category-digital-camera/?q=%da%86%d8%a7%d9%be%20%d8%b3%d8%b1%db%8c%d8%b9&entry=mm"
                                 class=" c-navi-new__medium-display-title">
                            دوربین‌ چاپ سریع
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--title"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: لوازم جانبی دوربین - level: 2"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"لوازم جانبی دوربین"}'
                            href="/search/category-camera-accessories/" class=" c-navi-new__big-display-title"><span>لوازم جانبی دوربین</span></a><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"لوازم جانبی دوربین"}'
                            href="/search/category-camera-accessories/" class=" c-navi-new__medium-display-title"><span>لوازم جانبی دوربین</span></a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: لنز - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"لنز"}'
                            href="/search/category-camera-lens/" class=" c-navi-new__big-display-title">
                            لنز
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"لنز"}'
                                 href="/search/category-camera-lens/" class=" c-navi-new__medium-display-title">
                            لنز
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: کیف - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"کیف"}'
                            href="/search/category-camera-bag/" class=" c-navi-new__big-display-title">
                            کیف
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"کیف"}'
                                 href="/search/category-camera-bag/" class=" c-navi-new__medium-display-title">
                            کیف
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: کارت حافظه - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"کارت حافظه"}'
                            href="/search/category-memory-cards/" class=" c-navi-new__big-display-title">
                            کارت حافظه
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"کارت حافظه"}'
                                 href="/search/category-memory-cards/" class=" c-navi-new__medium-display-title">
                            کارت حافظه
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: کاغذ چاپ عکس - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"کاغذ چاپ عکس"}'
                            href="/search/category-printer-paper/" class=" c-navi-new__big-display-title">
                            کاغذ چاپ عکس
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"کاغذ چاپ عکس"}'
                                 href="/search/category-printer-paper/" class=" c-navi-new__medium-display-title">
                            کاغذ چاپ عکس
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--title"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: دوربین دو چشمی و شکاری - level: 2"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"دوربین دو چشمی و شکاری"}'
                            href="/search/category-binoculars/" class=" c-navi-new__big-display-title"><span>دوربین دو چشمی و شکاری</span></a><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"دوربین دو چشمی و شکاری"}'
                            href="/search/category-binoculars/" class=" c-navi-new__medium-display-title"><span>دوربین دو چشمی و شکاری</span></a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--title"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: تلسکوپ - level: 2"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"تلسکوپ"}'
                            href="/search/category-telescope/"
                            class=" c-navi-new__big-display-title"><span>تلسکوپ</span></a><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"تلسکوپ"}'
                            href="/search/category-telescope/"
                            class=" c-navi-new__medium-display-title"><span>تلسکوپ</span></a></li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--title"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: پلی استیشن، ایکس باکس و بازی - level: 2"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"پلی استیشن، ایکس باکس و بازی"}'
                            href="/search/category-game-console/" class=" c-navi-new__big-display-title"><span>پلی استیشن، ایکس باکس و بازی</span></a><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"پلی استیشن، ایکس باکس و بازی"}'
                            href="/search/category-game-console/" class=" c-navi-new__medium-display-title"><span>پلی استیشن، ایکس باکس و بازی</span></a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--title"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en: Office Electronics - category_fa: کامپیوتر و تجهیزات جانبی - level: 2">
                          <a data-snt-event="dkMegaMenuClick"
                             data-snt-params='{"type":"option-title","category_title":"کامپیوتر و تجهیزات جانبی"}'
                             href="/search/category-computer-parts/" class=" c-navi-new__big-display-title"><span>کامپیوتر و تجهیزات جانبی</span></a><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"کامپیوتر و تجهیزات جانبی"}'
                            href="/search/category-computer-parts/" class=" c-navi-new__medium-display-title"><span>کامپیوتر و تجهیزات جانبی</span></a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: تجهیزات مخصوص بازی - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"تجهیزات مخصوص بازی"}'
                            href="/search/category-gaming-accessories/" class=" c-navi-new__big-display-title">
                            تجهیزات مخصوص بازی
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"تجهیزات مخصوص بازی"}'
                                 href="/search/category-gaming-accessories/" class=" c-navi-new__medium-display-title">
                            تجهیزات مخصوص بازی
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: مانیتور - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"مانیتور"}'
                            href="/search/category-monitor/" class=" c-navi-new__big-display-title">
                            مانیتور
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"مانیتور"}'
                                 href="/search/category-monitor/" class=" c-navi-new__medium-display-title">
                            مانیتور
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: کیس‌های اسمبل شده - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"کیس‌های اسمبل شده"}'
                            href="/search/category-assembled-cases/" class=" c-navi-new__big-display-title">
                            کیس‌های اسمبل شده
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"کیس‌های اسمبل شده"}'
                                 href="/search/category-assembled-cases/" class=" c-navi-new__medium-display-title">
                            کیس‌های اسمبل شده
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: قطعات داخلی کامپیوتر - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"قطعات داخلی کامپیوتر"}'
                            href="/search/category-computer-devices/" class=" c-navi-new__big-display-title">
                            قطعات داخلی کامپیوتر
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"قطعات داخلی کامپیوتر"}'
                                 href="/search/category-computer-devices/" class=" c-navi-new__medium-display-title">
                            قطعات داخلی کامپیوتر
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: ماوس - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"ماوس"}'
                            href="/search/category-mouse/" class=" c-navi-new__big-display-title">
                            ماوس
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"ماوس"}'
                                 href="/search/category-mouse/" class=" c-navi-new__medium-display-title">
                            ماوس
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: کیبورد - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"کیبورد"}'
                            href="/search//category-keyboard/" class=" c-navi-new__big-display-title">
                            کیبورد
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"کیبورد"}'
                                 href="/search//category-keyboard/" class=" c-navi-new__medium-display-title">
                            کیبورد
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--title"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en: Laptop - category_fa: لپ تاپ - level: 2"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"لپ تاپ"}'
                            href="/search/category-notebook-netbook-ultrabook/"
                            class=" c-navi-new__big-display-title"><span>لپ تاپ</span></a><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"لپ تاپ"}'
                            href="/search/category-notebook-netbook-ultrabook/"
                            class=" c-navi-new__medium-display-title"><span>لپ تاپ</span></a></li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--title"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: لوازم جانبی لپ تاپ - level: 2"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"لوازم جانبی لپ تاپ"}'
                            href="/search/category-laptop-accessories/" class=" c-navi-new__big-display-title"><span>لوازم جانبی لپ تاپ</span></a><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"لوازم جانبی لپ تاپ"}'
                            href="/search/category-laptop-accessories/" class=" c-navi-new__medium-display-title"><span>لوازم جانبی لپ تاپ</span></a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: کیف، کوله و کاور - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"کیف، کوله و کاور"}'
                            href="/search/category-laptop-bag/" class=" c-navi-new__big-display-title">
                            کیف، کوله و کاور
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"کیف، کوله و کاور"}'
                                 href="/search/category-laptop-bag/" class=" c-navi-new__medium-display-title">
                            کیف، کوله و کاور
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: کابل‌ صدا، AUX و HDMI - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"کابل‌ صدا، AUX و HDMI"}'
                            href="/search/category-cable-voice-video/" class=" c-navi-new__big-display-title">
                            کابل‌ صدا، AUX و HDMI
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"کابل‌ صدا، AUX و HDMI"}'
                                 href="/search/category-cable-voice-video/" class=" c-navi-new__medium-display-title">
                            کابل‌ صدا، AUX و HDMI
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--title"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en: Tablet - category_fa: تبلت - level: 2"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"تبلت"}'
                            href="https://www.digikala.com/search/category-tablet/"
                            class=" c-navi-new__big-display-title"><span>تبلت</span></a><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"تبلت"}'
                            href="https://www.digikala.com/search/category-tablet/"
                            class=" c-navi-new__medium-display-title"><span>تبلت</span></a></li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--title"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: شارژر تبلت و موبایل - level: 2"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"شارژر تبلت و موبایل"}'
                            href="/search/category-car-charger/" class=" c-navi-new__big-display-title"><span>شارژر تبلت و موبایل</span></a><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"شارژر تبلت و موبایل"}'
                            href="/search/category-car-charger/" class=" c-navi-new__medium-display-title"><span>شارژر تبلت و موبایل</span></a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--title"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en: Camera & Studio Equipment - category_fa: کیف، کاور، لوازم جانبی تبلت - level: 2">
                          <a data-snt-event="dkMegaMenuClick"
                             data-snt-params='{"type":"option-title","category_title":"کیف، کاور، لوازم جانبی تبلت"}'
                             href="/search/category-tablet-accessories/" class=" c-navi-new__big-display-title"><span>کیف، کاور، لوازم جانبی تبلت</span></a><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"کیف، کاور، لوازم جانبی تبلت"}'
                            href="/search/category-tablet-accessories/" class=" c-navi-new__medium-display-title"><span>کیف، کاور، لوازم جانبی تبلت</span></a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--title"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: باتری - level: 2"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"باتری"}'
                            href="/search/category-battery-charger-and-accesories/"
                            class=" c-navi-new__big-display-title"><span>باتری</span></a><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"باتری"}'
                            href="/search/category-battery-charger-and-accesories/"
                            class=" c-navi-new__medium-display-title"><span>باتری</span></a></li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--title"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: دوربین‌های تحت شبکه - level: 2"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"دوربین‌های تحت شبکه"}'
                            href="/search/category-network-cam/" class=" c-navi-new__big-display-title"><span>دوربین‌های تحت شبکه</span></a><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"دوربین‌های تحت شبکه"}'
                            href="/search/category-network-cam/" class=" c-navi-new__medium-display-title"><span>دوربین‌های تحت شبکه</span></a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--title"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en: Accessories - category_fa: مودم و تجهیزات شبکه - level: 2"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"مودم و تجهیزات شبکه"}'
                            href="/search/category-network/" class=" c-navi-new__big-display-title"><span>مودم و تجهیزات شبکه</span></a><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"مودم و تجهیزات شبکه"}'
                            href="/search/category-network/" class=" c-navi-new__medium-display-title"><span>مودم و تجهیزات شبکه</span></a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--title"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: ماشین های اداری - level: 2"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"ماشین های اداری"}'
                            href="/search/category-office-machines/" class=" c-navi-new__big-display-title"><span>ماشین های اداری</span></a><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"ماشین های اداری"}'
                            href="/search/category-office-machines/" class=" c-navi-new__medium-display-title"><span>ماشین های اداری</span></a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: تلفن، بی سیم و سانترال - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"تلفن، بی سیم و سانترال"}'
                            href="/search/category-telephone/" class=" c-navi-new__big-display-title">
                            تلفن، بی سیم و سانترال
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"تلفن، بی سیم و سانترال"}'
                                 href="/search/category-telephone/" class=" c-navi-new__medium-display-title">
                            تلفن، بی سیم و سانترال
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: فکس - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"فکس"}'
                            href="/search/category-fax/" class=" c-navi-new__big-display-title">
                            فکس
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"فکس"}'
                                 href="/search/category-fax/" class=" c-navi-new__medium-display-title">
                            فکس
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: پرینتر - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"پرینتر"}'
                            href="/search/category-printer/" class=" c-navi-new__big-display-title">
                            پرینتر
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"پرینتر"}'
                                 href="/search/category-printer/" class=" c-navi-new__medium-display-title">
                            پرینتر
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: لوازم جانبی اداری - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"لوازم جانبی اداری"}'
                            href="/search/category-office-accessories/" class=" c-navi-new__big-display-title">
                            لوازم جانبی اداری
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"لوازم جانبی اداری"}'
                                 href="/search/category-office-accessories/" class=" c-navi-new__medium-display-title">
                            لوازم جانبی اداری
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--title"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: کتابخوان فیدیبوک - level: 2"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"کتابخوان فیدیبوک"}'
                            href="/search/category-ebook-reader/?q=فیدیبوک&entry=mm"
                            class=" c-navi-new__big-display-title"><span>کتابخوان فیدیبوک</span></a><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"کتابخوان فیدیبوک"}'
                            href="/search/category-ebook-reader/?q=فیدیبوک&entry=mm"
                            class=" c-navi-new__medium-display-title"><span>کتابخوان فیدیبوک</span></a></li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--title"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: کارت هدیه خرید از {{ $fa_store_name }} - level: 2">
                          <a data-snt-event="dkMegaMenuClick"
                             data-snt-params='{"type":"option-title","category_title":"کارت هدیه خرید از {{ $fa_store_name }}"}'
                             href="/main/dk-ds-gift-card/" class=" c-navi-new__big-display-title"><span>کارت هدیه خرید از {{ $fa_store_name }}</span></a><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"کارت هدیه خرید از {{ $fa_store_name }}"}'
                            href="/main/dk-ds-gift-card/" class=" c-navi-new__medium-display-title"><span>کارت هدیه خرید از {{ $fa_store_name }}</span></a>
                        </li>
                      </ul>
                    </div>
                    <div class="c-navi-new-list__options-list  js-mega-menu-category-options" id="categories-2">
                      <div class="c-navi-new-list__sublist-top-bar"><a href="/main/vehicles/"
                                                                       class="c-navi-new-list__sublist-see-all-cats">
                          همه دسته‌بندی‌های وسایل نقلیه و صنعتی
                        </a>
                      </div>
                      <ul>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--title"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: خودروهای ایرانی و خارجی - level: 2"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"خودروهای ایرانی و خارجی"}'
                            href="/search/category-cars/" class=" c-navi-new__big-display-title"><span>خودروهای ایرانی و خارجی</span></a><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"خودروهای ایرانی و خارجی"}'
                            href="/search/category-cars/" class=" c-navi-new__medium-display-title"><span>خودروهای ایرانی و خارجی</span></a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--title"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: موتور سیکلت - level: 2"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"موتور سیکلت"}'
                            href="/search/category-motorbike/"
                            class=" c-navi-new__big-display-title"><span>موتور سیکلت</span></a><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"موتور سیکلت"}'
                            href="/search/category-motorbike/" class=" c-navi-new__medium-display-title"><span>موتور سیکلت</span></a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--title"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: لوازم جانبی خودرو و موتورسیکلت - level: 2"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"لوازم جانبی خودرو و موتورسیکلت"}'
                            href="/search/category-car-accessory-parts/" class=" c-navi-new__big-display-title"><span>لوازم جانبی خودرو و موتورسیکلت</span></a><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"لوازم جانبی خودرو و موتورسیکلت"}'
                            href="/search/category-car-accessory-parts/"
                            class=" c-navi-new__medium-display-title"><span>لوازم جانبی خودرو و موتورسیکلت</span></a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: لوازم تزیینی - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"لوازم تزیینی"}'
                            href="/search/category-in-car-accessorie/" class=" c-navi-new__big-display-title">
                            لوازم تزیینی
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"لوازم تزیینی"}'
                                 href="/search/category-in-car-accessorie/" class=" c-navi-new__medium-display-title">
                            لوازم تزیینی
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: سیستم صوتی و تصویری - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"سیستم صوتی و تصویری"}'
                            href="/search/category-car-stereo/" class=" c-navi-new__big-display-title">
                            سیستم صوتی و تصویری
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"سیستم صوتی و تصویری"}'
                                 href="/search/category-car-stereo/" class=" c-navi-new__medium-display-title">
                            سیستم صوتی و تصویری
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: نظافت و نگهداری خودرو - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"نظافت و نگهداری خودرو"}'
                            href="/search/category-car-cleaning-and-maintenance/"
                            class=" c-navi-new__big-display-title">
                            نظافت و نگهداری خودرو
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"نظافت و نگهداری خودرو"}'
                                 href="/search/category-car-cleaning-and-maintenance/"
                                 class=" c-navi-new__medium-display-title">
                            نظافت و نگهداری خودرو
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: کلاه کاسکت و  لوازم جانبی موتور - level: 3">
                          <a data-snt-event="dkMegaMenuClick"
                             data-snt-params='{"type":"option-item","category_title":"کلاه کاسکت و  لوازم جانبی موتور"}'
                             href="/search/category-motorbike-accessory-parts/" class=" c-navi-new__big-display-title">
                            کلاه کاسکت و لوازم جانبی موتور
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"کلاه کاسکت و  لوازم جانبی موتور"}'
                                 href="/search/category-motorbike-accessory-parts/"
                                 class=" c-navi-new__medium-display-title">
                            کلاه کاسکت و لوازم جانبی موتور
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--title"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: لوازم یدکی خودرو و موتورسیکلت - level: 2"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"لوازم یدکی خودرو و موتورسیکلت"}'
                            href="/search/category-car-spare-parts/" class=" c-navi-new__big-display-title"><span>لوازم یدکی خودرو و موتورسیکلت</span></a><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"لوازم یدکی خودرو و موتورسیکلت"}'
                            href="/search/category-car-spare-parts/" class=" c-navi-new__medium-display-title"><span>لوازم یدکی خودرو و موتورسیکلت</span></a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: دیسک و صفحه کلاچ - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"دیسک و صفحه کلاچ"}'
                            href="/search/category-clutch-kit/" class=" c-navi-new__big-display-title">
                            دیسک و صفحه کلاچ
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"دیسک و صفحه کلاچ"}'
                                 href="/search/category-clutch-kit/" class=" c-navi-new__medium-display-title">
                            دیسک و صفحه کلاچ
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: جلوبندی و تعلیق - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"جلوبندی و تعلیق"}'
                            href="/search/category-suspension-systems-and-component/"
                            class=" c-navi-new__big-display-title">
                            جلوبندی و تعلیق
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"جلوبندی و تعلیق"}'
                                 href="/search/category-suspension-systems-and-component/"
                                 class=" c-navi-new__medium-display-title">
                            جلوبندی و تعلیق
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: چراغ خودرو - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"چراغ خودرو"}'
                            href="/search/category-automotive-lighting/" class=" c-navi-new__big-display-title">
                            چراغ خودرو
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"چراغ خودرو"}'
                                 href="/search/category-automotive-lighting/" class=" c-navi-new__medium-display-title">
                            چراغ خودرو
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: تسمه خودرو - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"تسمه خودرو"}'
                            href="/search/category-engine-belt/" class=" c-navi-new__big-display-title">
                            تسمه خودرو
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"تسمه خودرو"}'
                                 href="/search/category-engine-belt/" class=" c-navi-new__medium-display-title">
                            تسمه خودرو
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: کمک فنر - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"کمک فنر"}'
                            href="/search/category-shock-absorber/" class=" c-navi-new__big-display-title">
                            کمک فنر
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"کمک فنر"}'
                                 href="/search/category-shock-absorber/" class=" c-navi-new__medium-display-title">
                            کمک فنر
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--title"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: لوازم مصرفی خودرو و موتورسیکلت - level: 2"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"لوازم مصرفی خودرو و موتورسیکلت"}'
                            href="/search/category-consumable-parts/" class=" c-navi-new__big-display-title"><span>لوازم مصرفی خودرو و موتورسیکلت</span></a><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"لوازم مصرفی خودرو و موتورسیکلت"}'
                            href="/search/category-consumable-parts/" class=" c-navi-new__medium-display-title"><span>لوازم مصرفی خودرو و موتورسیکلت</span></a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: لاستیک و تایر - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"لاستیک و تایر"}'
                            href="/search/category-tire/" class=" c-navi-new__big-display-title">
                            لاستیک و تایر
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"لاستیک و تایر"}'
                                 href="/search/category-tire/" class=" c-navi-new__medium-display-title">
                            لاستیک و تایر
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: لنت ترمز - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"لنت ترمز"}'
                            href="/search/category-brake-pad/" class=" c-navi-new__big-display-title">
                            لنت ترمز
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"لنت ترمز"}'
                                 href="/search/category-brake-pad/" class=" c-navi-new__medium-display-title">
                            لنت ترمز
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: روغن موتور و ضد یخ - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"روغن موتور و ضد یخ"}'
                            href="/search/category-oils-and-additives/" class=" c-navi-new__big-display-title">
                            روغن موتور و ضد یخ
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"روغن موتور و ضد یخ"}'
                                 href="/search/category-oils-and-additives/" class=" c-navi-new__medium-display-title">
                            روغن موتور و ضد یخ
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: مکمل سوخت و روغن و انواع فیلتر - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"مکمل سوخت و روغن و انواع فیلتر"}'
                            href="/search/category-car-oil-and-fuel-additive/" class=" c-navi-new__big-display-title">
                            مکمل سوخت و روغن و انواع فیلتر
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"مکمل سوخت و روغن و انواع فیلتر"}'
                                 href="/search/category-car-oil-and-fuel-additive/"
                                 class=" c-navi-new__medium-display-title">
                            مکمل سوخت و روغن و انواع فیلتر
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--title"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en: Sport Gadgets - category_fa: ابزار برقی - level: 2"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"ابزار برقی"}'
                            href="/search/category-power-tools/"
                            class=" c-navi-new__big-display-title"><span>ابزار برقی</span></a><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"ابزار برقی"}'
                            href="/search/category-power-tools/" class=" c-navi-new__medium-display-title"><span>ابزار برقی</span></a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: دریل، پیچ گوشتی برقی و شارژی - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"دریل، پیچ گوشتی برقی و شارژی"}'
                            href="/search/category-cordlessscrewdriver/" class=" c-navi-new__big-display-title">
                            دریل، پیچ گوشتی برقی و شارژی
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"دریل، پیچ گوشتی برقی و شارژی"}'
                                 href="/search/category-cordlessscrewdriver/" class=" c-navi-new__medium-display-title">
                            دریل، پیچ گوشتی برقی و شارژی
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: فرز و سنگ رومیزی - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"فرز و سنگ رومیزی"}'
                            href="/search/category-anglegrinder/" class=" c-navi-new__big-display-title">
                            فرز و سنگ رومیزی
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"فرز و سنگ رومیزی"}'
                                 href="/search/category-anglegrinder/" class=" c-navi-new__medium-display-title">
                            فرز و سنگ رومیزی
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: موتور برق - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"موتور برق"}'
                            href="/search/category-electric-engine/" class=" c-navi-new__big-display-title">
                            موتور برق
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"موتور برق"}'
                                 href="/search/category-electric-engine/" class=" c-navi-new__medium-display-title">
                            موتور برق
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: مکنده و دمنده - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"مکنده و دمنده"}'
                            href="/search/category-blower/" class=" c-navi-new__big-display-title">
                            مکنده و دمنده
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"مکنده و دمنده"}'
                                 href="/search/category-blower/" class=" c-navi-new__medium-display-title">
                            مکنده و دمنده
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: کارواش - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"کارواش"}'
                            href="/search/category-carwash/" class=" c-navi-new__big-display-title">
                            کارواش
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"کارواش"}'
                                 href="/search/category-carwash/" class=" c-navi-new__medium-display-title">
                            کارواش
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: کمپرسور و جک خودرو - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"کمپرسور و جک خودرو"}'
                            href="/search/category-car-tools/" class=" c-navi-new__big-display-title">
                            کمپرسور و جک خودرو
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"کمپرسور و جک خودرو"}'
                                 href="/search/category-car-tools/" class=" c-navi-new__medium-display-title">
                            کمپرسور و جک خودرو
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: ابزار همه کاره برقی و شارژی - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"ابزار همه کاره برقی و شارژی"}'
                            href="/search/category-multitool/" class=" c-navi-new__big-display-title">
                            ابزار همه کاره برقی و شارژی
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"ابزار همه کاره برقی و شارژی"}'
                                 href="/search/category-multitool/" class=" c-navi-new__medium-display-title">
                            ابزار همه کاره برقی و شارژی
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--title"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: ابزار غیر برقی - level: 2"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"ابزار غیر برقی"}'
                            href="/search/category-non-electrical-tools/" class=" c-navi-new__big-display-title"><span>ابزار غیر برقی</span></a><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"ابزار غیر برقی"}'
                            href="/search/category-non-electrical-tools/"
                            class=" c-navi-new__medium-display-title"><span>ابزار غیر برقی</span></a></li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: ابزار دستی - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"ابزار دستی"}'
                            href="/search/category-hand-tools/" class=" c-navi-new__big-display-title">
                            ابزار دستی
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"ابزار دستی"}'
                                 href="/search/category-hand-tools/" class=" c-navi-new__medium-display-title">
                            ابزار دستی
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: مجموعه ابزار - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"مجموعه ابزار"}'
                            href="/search/category-tools-set/" class=" c-navi-new__big-display-title">
                            مجموعه ابزار
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"مجموعه ابزار"}'
                                 href="/search/category-tools-set/" class=" c-navi-new__medium-display-title">
                            مجموعه ابزار
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: نردبان - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"نردبان"}'
                            href="/search/category-ladders/" class=" c-navi-new__big-display-title">
                            نردبان
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"نردبان"}'
                                 href="/search/category-ladders/" class=" c-navi-new__medium-display-title">
                            نردبان
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: پیچ گوشتی و فازمتر - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"پیچ گوشتی و فازمتر"}'
                            href="/search/category-screwdriver/" class=" c-navi-new__big-display-title">
                            پیچ گوشتی و فازمتر
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"پیچ گوشتی و فازمتر"}'
                                 href="/search/category-screwdriver/" class=" c-navi-new__medium-display-title">
                            پیچ گوشتی و فازمتر
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: نظم دهنده ابزار - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"نظم دهنده ابزار"}'
                            href="/search/category-tool-organizer/" class=" c-navi-new__big-display-title">
                            نظم دهنده ابزار
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"نظم دهنده ابزار"}'
                                 href="/search/category-tool-organizer/" class=" c-navi-new__medium-display-title">
                            نظم دهنده ابزار
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: متر، تراز، اندازه‌گیری دقیق - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"متر، تراز، اندازه‌گیری دقیق"}'
                            href="/search/category-measurement/" class=" c-navi-new__big-display-title">
                            متر، تراز، اندازه‌گیری دقیق
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"متر، تراز، اندازه‌گیری دقیق"}'
                                 href="/search/category-measurement/" class=" c-navi-new__medium-display-title">
                            متر، تراز، اندازه‌گیری دقیق
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: لوازم روانکاری - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"لوازم روانکاری"}'
                            href="/search/category-oilcan/" class=" c-navi-new__big-display-title">
                            لوازم روانکاری
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"لوازم روانکاری"}'
                                 href="/search/category-oilcan/" class=" c-navi-new__medium-display-title">
                            لوازم روانکاری
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: چسب صنعتی - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"چسب صنعتی"}'
                            href="/search/category-industrial-glue/" class=" c-navi-new__big-display-title">
                            چسب صنعتی
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"چسب صنعتی"}'
                                 href="/search/category-industrial-glue/" class=" c-navi-new__medium-display-title">
                            چسب صنعتی
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--title"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: لوازم و یراق آلات ساختمانی - level: 2"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"لوازم و یراق آلات ساختمانی"}'
                            href="/search/category-construction-tools-and-equipment/"
                            class=" c-navi-new__big-display-title"><span>لوازم و یراق آلات ساختمانی</span></a><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"لوازم و یراق آلات ساختمانی"}'
                            href="/search/category-construction-tools-and-equipment/"
                            class=" c-navi-new__medium-display-title"><span>لوازم و یراق آلات ساختمانی</span></a></li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: شیرآلات - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"شیرآلات"}'
                            href="/search/category-faucets/" class=" c-navi-new__big-display-title">
                            شیرآلات
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"شیرآلات"}'
                                 href="/search/category-faucets/" class=" c-navi-new__medium-display-title">
                            شیرآلات
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: رنگ - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"رنگ"}'
                            href="/search/category-color/" class=" c-navi-new__big-display-title">
                            رنگ
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"رنگ"}'
                                 href="/search/category-color/" class=" c-navi-new__medium-display-title">
                            رنگ
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: دستگیره در - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"دستگیره در"}'
                            href="/search/category-doorknob/" class=" c-navi-new__big-display-title">
                            دستگیره در
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"دستگیره در"}'
                                 href="/search/category-doorknob/" class=" c-navi-new__medium-display-title">
                            دستگیره در
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--title"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: لوازم باغبانی - level: 2"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"لوازم باغبانی"}'
                            href="/search/category-gardening-tools/" class=" c-navi-new__big-display-title"><span>لوازم باغبانی</span></a><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"لوازم باغبانی"}'
                            href="/search/category-gardening-tools/" class=" c-navi-new__medium-display-title"><span>لوازم باغبانی</span></a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: قیچی‌، چاقو و ابزار باغبانی - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"قیچی‌، چاقو و ابزار باغبانی"}'
                            href="/search/category-scissors/" class=" c-navi-new__big-display-title">
                            قیچی‌، چاقو و ابزار باغبانی
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"قیچی‌، چاقو و ابزار باغبانی"}'
                                 href="/search/category-scissors/" class=" c-navi-new__medium-display-title">
                            قیچی‌، چاقو و ابزار باغبانی
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: بذر و تخم گیاهان - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"بذر و تخم گیاهان"}'
                            href="/search/category-plants-grain-and-seeds/" class=" c-navi-new__big-display-title">
                            بذر و تخم گیاهان
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"بذر و تخم گیاهان"}'
                                 href="/search/category-plants-grain-and-seeds/"
                                 class=" c-navi-new__medium-display-title">
                            بذر و تخم گیاهان
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: تبر، بیل و کلنگ - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"تبر، بیل و کلنگ"}'
                            href="/search/category-axeshovelandpick/" class=" c-navi-new__big-display-title">
                            تبر، بیل و کلنگ
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"تبر، بیل و کلنگ"}'
                                 href="/search/category-axeshovelandpick/" class=" c-navi-new__medium-display-title">
                            تبر، بیل و کلنگ
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: خاک، کود و آفت کش - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"خاک، کود و آفت کش"}'
                            href="/search/category-soils-and-fertilizers/" class=" c-navi-new__big-display-title">
                            خاک، کود و آفت کش
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"خاک، کود و آفت کش"}'
                                 href="/search/category-soils-and-fertilizers/"
                                 class=" c-navi-new__medium-display-title">
                            خاک، کود و آفت کش
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--title"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: نور و روشنایی - level: 2"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"نور و روشنایی"}'
                            href="/search/category-lighting/"
                            class=" c-navi-new__big-display-title"><span>نور و روشنایی</span></a><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"نور و روشنایی"}'
                            href="/search/category-lighting/" class=" c-navi-new__medium-display-title"><span>نور و روشنایی</span></a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: لوسترو آباژور - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"لوسترو آباژور"}'
                            href="/search/category-hanging-lamps/" class=" c-navi-new__big-display-title">
                            لوسترو آباژور
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"لوسترو آباژور"}'
                                 href="/search/category-hanging-lamps/" class=" c-navi-new__medium-display-title">
                            لوسترو آباژور
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: لامپ - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"لامپ"}'
                            href="/search/category-lamp/" class=" c-navi-new__big-display-title">
                            لامپ
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"لامپ"}'
                                 href="/search/category-lamp/" class=" c-navi-new__medium-display-title">
                            لامپ
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: چندراهی برق و محافظ ولتاژ - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"چندراهی برق و محافظ ولتاژ"}'
                            href="/search/category-power-strip/" class=" c-navi-new__big-display-title">
                            چندراهی برق و محافظ ولتاژ
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"چندراهی برق و محافظ ولتاژ"}'
                                 href="/search/category-power-strip/" class=" c-navi-new__medium-display-title">
                            چندراهی برق و محافظ ولتاژ
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--title"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: تجهیزات ایمنی و کار - level: 2"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"تجهیزات ایمنی و کار"}'
                            href="/search/category-safety-tools/" class=" c-navi-new__big-display-title"><span>تجهیزات ایمنی و کار</span></a><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"تجهیزات ایمنی و کار"}'
                            href="/search/category-safety-tools/" class=" c-navi-new__medium-display-title"><span>تجهیزات ایمنی و کار</span></a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: کفش ایمنی - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"کفش ایمنی"}'
                            href="/search/category-safety-shoes/" class=" c-navi-new__big-display-title">
                            کفش ایمنی
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"کفش ایمنی"}'
                                 href="/search/category-safety-shoes/" class=" c-navi-new__medium-display-title">
                            کفش ایمنی
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--title"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: حفاظتی و امنیتی - level: 2"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"حفاظتی و امنیتی"}'
                            href="/search/category-protection-and-security-equipment/"
                            class=" c-navi-new__big-display-title"><span>حفاظتی و امنیتی</span></a><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"حفاظتی و امنیتی"}'
                            href="/search/category-protection-and-security-equipment/"
                            class=" c-navi-new__medium-display-title"><span>حفاظتی و امنیتی</span></a></li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: گاوصندوق - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"گاوصندوق"}'
                            href="/search/category-safe/" class=" c-navi-new__big-display-title">
                            گاوصندوق
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"گاوصندوق"}'
                                 href="/search/category-safe/" class=" c-navi-new__medium-display-title">
                            گاوصندوق
                          </a>
                        </li>
                      </ul>
                    </div>
                    <div class="c-navi-new-list__options-list  js-mega-menu-category-options" id="categories-3">
                      <div class="c-navi-new-list__sublist-top-bar"><a href="/main/apparel/"
                                                                       class="c-navi-new-list__sublist-see-all-cats">
                          همه دسته‌بندی‌های مد و پوشاک
                        </a><a href="https://www.digistyle.com" target="_blank"
                               class="c-navi-new-list__sublist-top-bar-image"><img
                            src="https://www.digikala.com/static/files/5851ec93.svg"/></a>
                      </div>
                      <ul>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--title"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: مردانه - level: 2"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"مردانه"}'
                            href="/search/category-mens-apparel/"
                            class=" c-navi-new__big-display-title"><span>مردانه</span></a><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"مردانه"}'
                            href="/search/category-mens-apparel/"
                            class=" c-navi-new__medium-display-title"><span>مردانه</span></a></li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--title"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: لباس مردانه - level: 2"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"لباس مردانه"}'
                            href="/search/category-men-clothing/" class=" c-navi-new__big-display-title"><span>لباس مردانه</span></a><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"لباس مردانه"}'
                            href="/search/category-men-clothing/" class=" c-navi-new__medium-display-title"><span>لباس مردانه</span></a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: تی شرت و پولو شرت - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"تی شرت و پولو شرت"}'
                            href="/search/category-men-tee-shirts-and-polos/" class=" c-navi-new__big-display-title">
                            تی شرت و پولو شرت
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"تی شرت و پولو شرت"}'
                                 href="/search/category-men-tee-shirts-and-polos/"
                                 class=" c-navi-new__medium-display-title">
                            تی شرت و پولو شرت
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: پیراهن - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"پیراهن"}'
                            href="/search/category-men-shirts/" class=" c-navi-new__big-display-title">
                            پیراهن
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"پیراهن"}'
                                 href="/search/category-men-shirts/" class=" c-navi-new__medium-display-title">
                            پیراهن
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: شلوار - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"شلوار"}'
                            href="/search/category-men-trousers-jumpsuits/" class=" c-navi-new__big-display-title">
                            شلوار
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"شلوار"}'
                                 href="/search/category-men-trousers-jumpsuits/"
                                 class=" c-navi-new__medium-display-title">
                            شلوار
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: لباس زیر - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"لباس زیر"}'
                            href="/search/category-men-underwear/" class=" c-navi-new__big-display-title">
                            لباس زیر
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"لباس زیر"}'
                                 href="/search/category-men-underwear/" class=" c-navi-new__medium-display-title">
                            لباس زیر
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--title"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: کفش مردانه - level: 2"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"کفش مردانه"}'
                            href="/search/category-men-shoes/"
                            class=" c-navi-new__big-display-title"><span>کفش مردانه</span></a><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"کفش مردانه"}'
                            href="/search/category-men-shoes/" class=" c-navi-new__medium-display-title"><span>کفش مردانه</span></a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: کفش روزمره - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"کفش روزمره"}'
                            href="/search/category-casual-shoes-for-men/" class=" c-navi-new__big-display-title">
                            کفش روزمره
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"کفش روزمره"}'
                                 href="/search/category-casual-shoes-for-men/"
                                 class=" c-navi-new__medium-display-title">
                            کفش روزمره
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: کفش رسمی - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"کفش رسمی"}'
                            href="/search/category-men-formal-shoes/" class=" c-navi-new__big-display-title">
                            کفش رسمی
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"کفش رسمی"}'
                                 href="/search/category-men-formal-shoes/" class=" c-navi-new__medium-display-title">
                            کفش رسمی
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--title"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: اکسسوری مردانه - level: 2"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"اکسسوری مردانه"}'
                            href="/search/category-men-accessories/" class=" c-navi-new__big-display-title"><span>اکسسوری مردانه</span></a><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"اکسسوری مردانه"}'
                            href="/search/category-men-accessories/" class=" c-navi-new__medium-display-title"><span>اکسسوری مردانه</span></a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: ساعت - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"ساعت"}'
                            href="/search/category-men-watches/" class=" c-navi-new__big-display-title">
                            ساعت
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"ساعت"}'
                                 href="/search/category-men-watches/" class=" c-navi-new__medium-display-title">
                            ساعت
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: کیف - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"کیف"}'
                            href="/search/category-men-bags/" class=" c-navi-new__big-display-title">
                            کیف
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"کیف"}'
                                 href="/search/category-men-bags/" class=" c-navi-new__medium-display-title">
                            کیف
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: کمربند - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"کمربند"}'
                            href="/search/category-men-belts/" class=" c-navi-new__big-display-title">
                            کمربند
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"کمربند"}'
                                 href="/search/category-men-belts/" class=" c-navi-new__medium-display-title">
                            کمربند
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--title"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en: Women - category_fa: زنانه - level: 2"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"زنانه"}'
                            href="/search/category-womens-apparel/"
                            class=" c-navi-new__big-display-title"><span>زنانه</span></a><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"زنانه"}'
                            href="/search/category-womens-apparel/" class=" c-navi-new__medium-display-title"><span>زنانه</span></a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--title"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: لباس زنانه - level: 2"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"لباس زنانه"}'
                            href="/search/category-women-clothing/" class=" c-navi-new__big-display-title"><span>لباس زنانه</span></a><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"لباس زنانه"}'
                            href="/search/category-women-clothing/" class=" c-navi-new__medium-display-title"><span>لباس زنانه</span></a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: پوشش اسلامی و مانتو - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"پوشش اسلامی و مانتو"}'
                            href="/search/category-women-islamicwear/" class=" c-navi-new__big-display-title">
                            پوشش اسلامی و مانتو
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"پوشش اسلامی و مانتو"}'
                                 href="/search/category-women-islamicwear/" class=" c-navi-new__medium-display-title">
                            پوشش اسلامی و مانتو
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: بلوز و شومیز - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"بلوز و شومیز"}'
                            href="/search/category-women-shirts/" class=" c-navi-new__big-display-title">
                            بلوز و شومیز
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"بلوز و شومیز"}'
                                 href="/search/category-women-shirts/" class=" c-navi-new__medium-display-title">
                            بلوز و شومیز
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: تی شرت و پولوشرت - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"تی شرت و پولوشرت"}'
                            href="/search/category-women-tee-shirts-and-polos/" class=" c-navi-new__big-display-title">
                            تی شرت و پولوشرت
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"تی شرت و پولوشرت"}'
                                 href="/search/category-women-tee-shirts-and-polos/"
                                 class=" c-navi-new__medium-display-title">
                            تی شرت و پولوشرت
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: شلوار و سرهمی - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"شلوار و سرهمی"}'
                            href="/search/category-women-trousers-and-jumpsuits/"
                            class=" c-navi-new__big-display-title">
                            شلوار و سرهمی
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"شلوار و سرهمی"}'
                                 href="/search/category-women-trousers-and-jumpsuits/"
                                 class=" c-navi-new__medium-display-title">
                            شلوار و سرهمی
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: لباس زیر - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"لباس زیر"}'
                            href="/search/category-women-underwear/" class=" c-navi-new__big-display-title">
                            لباس زیر
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"لباس زیر"}'
                                 href="/search/category-women-underwear/" class=" c-navi-new__medium-display-title">
                            لباس زیر
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--title"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: کفش زنانه - level: 2"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"کفش زنانه"}'
                            href="/search/category-women-shoes/"
                            class=" c-navi-new__big-display-title"><span>کفش زنانه</span></a><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"کفش زنانه"}'
                            href="/search/category-women-shoes/" class=" c-navi-new__medium-display-title"><span>کفش زنانه</span></a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: کفش روزمره - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"کفش روزمره"}'
                            href="/search/category-casual-shoes-for-women/" class=" c-navi-new__big-display-title">
                            کفش روزمره
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"کفش روزمره"}'
                                 href="/search/category-casual-shoes-for-women/"
                                 class=" c-navi-new__medium-display-title">
                            کفش روزمره
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: کفش تخت - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"کفش تخت"}'
                            href="/search/category-women-flat-shoes/" class=" c-navi-new__big-display-title">
                            کفش تخت
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"کفش تخت"}'
                                 href="/search/category-women-flat-shoes/" class=" c-navi-new__medium-display-title">
                            کفش تخت
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--title"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: اکسسوری زنانه - level: 2"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"اکسسوری زنانه"}'
                            href="/search/category-women-accessories/" class=" c-navi-new__big-display-title"><span>اکسسوری زنانه</span></a><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"اکسسوری زنانه"}'
                            href="/search/category-women-accessories/" class=" c-navi-new__medium-display-title"><span>اکسسوری زنانه</span></a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: ساعت - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"ساعت"}'
                            href="/search/category-women-watches/" class=" c-navi-new__big-display-title">
                            ساعت
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"ساعت"}'
                                 href="/search/category-women-watches/" class=" c-navi-new__medium-display-title">
                            ساعت
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: کیف - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"کیف"}'
                            href="/search/category-women-bags/" class=" c-navi-new__big-display-title">
                            کیف
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"کیف"}'
                                 href="/search/category-women-bags/" class=" c-navi-new__medium-display-title">
                            کیف
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: شال و روسری - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"شال و روسری"}'
                            href="/search/category-women-scarves/" class=" c-navi-new__big-display-title">
                            شال و روسری
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"شال و روسری"}'
                                 href="/search/category-women-scarves/" class=" c-navi-new__medium-display-title">
                            شال و روسری
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--title"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: زیورآلات زنانه - level: 2"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"زیورآلات زنانه"}'
                            href="/search/category-women-jewelry/" class=" c-navi-new__big-display-title"><span>زیورآلات زنانه</span></a><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"زیورآلات زنانه"}'
                            href="/search/category-women-jewelry/" class=" c-navi-new__medium-display-title"><span>زیورآلات زنانه</span></a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: دستبند - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"دستبند"}'
                            href="/search/category-women-bracelet/" class=" c-navi-new__big-display-title">
                            دستبند
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"دستبند"}'
                                 href="/search/category-women-bracelet/" class=" c-navi-new__medium-display-title">
                            دستبند
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: گوشواره - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"گوشواره"}'
                            href="/search/category-women-earrings/" class=" c-navi-new__big-display-title">
                            گوشواره
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"گوشواره"}'
                                 href="/search/category-women-earrings/" class=" c-navi-new__medium-display-title">
                            گوشواره
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: گردنبند - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"گردنبند"}'
                            href="/search/category-women-necklace/" class=" c-navi-new__big-display-title">
                            گردنبند
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"گردنبند"}'
                                 href="/search/category-women-necklace/" class=" c-navi-new__medium-display-title">
                            گردنبند
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--title"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: زیورآلات طلا زنانه - level: 2"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"زیورآلات طلا زنانه"}'
                            href="/search/category-women-gold-jewelry/" class=" c-navi-new__big-display-title"><span>زیورآلات طلا زنانه</span></a><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"زیورآلات طلا زنانه"}'
                            href="/search/category-women-gold-jewelry/" class=" c-navi-new__medium-display-title"><span>زیورآلات طلا زنانه</span></a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: دستبند - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"دستبند"}'
                            href="/search/category-women-gold-bracelet/" class=" c-navi-new__big-display-title">
                            دستبند
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"دستبند"}'
                                 href="/search/category-women-gold-bracelet/" class=" c-navi-new__medium-display-title">
                            دستبند
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: گوشواره - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"گوشواره"}'
                            href="/search/category-women-gold-earrings/" class=" c-navi-new__big-display-title">
                            گوشواره
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"گوشواره"}'
                                 href="/search/category-women-gold-earrings/" class=" c-navi-new__medium-display-title">
                            گوشواره
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: آویز - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"آویز"}'
                            href="/search/category-women-gold-pendants/" class=" c-navi-new__big-display-title">
                            آویز
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"آویز"}'
                                 href="/search/category-women-gold-pendants/" class=" c-navi-new__medium-display-title">
                            آویز
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: گردنبند - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"گردنبند"}'
                            href="/search/category-women-gold-necklace/" class=" c-navi-new__big-display-title">
                            گردنبند
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"گردنبند"}'
                                 href="/search/category-women-gold-necklace/" class=" c-navi-new__medium-display-title">
                            گردنبند
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--title"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: زیورآلات نقره زنانه - level: 2"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"زیورآلات نقره زنانه"}'
                            href="/search/category-women-silver-jewelry/" class=" c-navi-new__big-display-title"><span>زیورآلات نقره زنانه</span></a><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"زیورآلات نقره زنانه"}'
                            href="/search/category-women-silver-jewelry/"
                            class=" c-navi-new__medium-display-title"><span>زیورآلات نقره زنانه</span></a></li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--title"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: عینک آفتابی زنانه - level: 2"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"عینک آفتابی زنانه"}'
                            href="/search/category-women-eyewear/" class=" c-navi-new__big-display-title"><span>عینک آفتابی زنانه</span></a><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"عینک آفتابی زنانه"}'
                            href="/search/category-women-eyewear/" class=" c-navi-new__medium-display-title"><span>عینک آفتابی زنانه</span></a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--title"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: عینک آفتابی مردانه - level: 2"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"عینک آفتابی مردانه"}'
                            href="/search/category-men-eyewear/" class=" c-navi-new__big-display-title"><span>عینک آفتابی مردانه</span></a><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"عینک آفتابی مردانه"}'
                            href="/search/category-men-eyewear/" class=" c-navi-new__medium-display-title"><span>عینک آفتابی مردانه</span></a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--title"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: پوشاک ورزشی مردانه - level: 2"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"پوشاک ورزشی مردانه"}'
                            href="/search/category-men-sportswear/" class=" c-navi-new__big-display-title"><span>پوشاک ورزشی مردانه</span></a><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"پوشاک ورزشی مردانه"}'
                            href="/search/category-men-sportswear/" class=" c-navi-new__medium-display-title"><span>پوشاک ورزشی مردانه</span></a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--title"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: پوشاک ورزشی زنانه - level: 2"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"پوشاک ورزشی زنانه"}'
                            href="/search/category-women-sportwear/" class=" c-navi-new__big-display-title"><span>پوشاک ورزشی زنانه</span></a><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"پوشاک ورزشی زنانه"}'
                            href="/search/category-women-sportwear/" class=" c-navi-new__medium-display-title"><span>پوشاک ورزشی زنانه</span></a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--title"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: کفش ورزشی مردانه - level: 2"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"کفش ورزشی مردانه"}'
                            href="/search/category-men-sport-shoes-/" class=" c-navi-new__big-display-title"><span>کفش ورزشی مردانه</span></a><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"کفش ورزشی مردانه"}'
                            href="/search/category-men-sport-shoes-/" class=" c-navi-new__medium-display-title"><span>کفش ورزشی مردانه</span></a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--title"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: کفش ورزشی زنانه - level: 2"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"کفش ورزشی زنانه"}'
                            href="/search/category-women-sport-shoes-/" class=" c-navi-new__big-display-title"><span>کفش ورزشی زنانه</span></a><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"کفش ورزشی زنانه"}'
                            href="/search/category-women-sport-shoes-/" class=" c-navi-new__medium-display-title"><span>کفش ورزشی زنانه</span></a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--title"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: پوشاک ورزشی پسرانه - level: 2"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"پوشاک ورزشی پسرانه"}'
                            href="/search/category-boys-sportswear/" class=" c-navi-new__big-display-title"><span>پوشاک ورزشی پسرانه</span></a><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"پوشاک ورزشی پسرانه"}'
                            href="/search/category-boys-sportswear/" class=" c-navi-new__medium-display-title"><span>پوشاک ورزشی پسرانه</span></a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--title"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: پوشاک ورزشی دخترانه - level: 2"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"پوشاک ورزشی دخترانه"}'
                            href="/search/category-girls-sportswear/" class=" c-navi-new__big-display-title"><span>پوشاک ورزشی دخترانه</span></a><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"پوشاک ورزشی دخترانه"}'
                            href="/search/category-girls-sportswear/" class=" c-navi-new__medium-display-title"><span>پوشاک ورزشی دخترانه</span></a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--title"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: کفش ورزشی پسرانه - level: 2"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"کفش ورزشی پسرانه"}'
                            href="/search/category-boys-sport-shoes/" class=" c-navi-new__big-display-title"><span>کفش ورزشی پسرانه</span></a><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"کفش ورزشی پسرانه"}'
                            href="/search/category-boys-sport-shoes/" class=" c-navi-new__medium-display-title"><span>کفش ورزشی پسرانه</span></a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--title"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: کفش ورزشی دخترانه - level: 2"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"کفش ورزشی دخترانه"}'
                            href="/search/category-girls-sport-shoes/" class=" c-navi-new__big-display-title"><span>کفش ورزشی دخترانه</span></a><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"کفش ورزشی دخترانه"}'
                            href="/search/category-girls-sport-shoes/" class=" c-navi-new__medium-display-title"><span>کفش ورزشی دخترانه</span></a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--title"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: کوله پشتی مردانه - level: 2"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"کوله پشتی مردانه"}'
                            href="/search/category-men-backpacks/" class=" c-navi-new__big-display-title"><span>کوله پشتی مردانه</span></a><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"کوله پشتی مردانه"}'
                            href="/search/category-men-backpacks/" class=" c-navi-new__medium-display-title"><span>کوله پشتی مردانه</span></a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--title"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: بچه گانه - level: 2"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"بچه گانه"}'
                            href="/search/category-kids-apparel/"
                            class=" c-navi-new__big-display-title"><span>بچه گانه</span></a><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"بچه گانه"}'
                            href="/search/category-kids-apparel/" class=" c-navi-new__medium-display-title"><span>بچه گانه</span></a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: نوزاد - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"نوزاد"}'
                            href="/search/category-kids-clothes/" class=" c-navi-new__big-display-title">
                            نوزاد
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"نوزاد"}'
                                 href="/search/category-kids-clothes/" class=" c-navi-new__medium-display-title">
                            نوزاد
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: پسرانه - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"پسرانه"}'
                            href="/search/category-boys-clothing/" class=" c-navi-new__big-display-title">
                            پسرانه
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"پسرانه"}'
                                 href="/search/category-boys-clothing/" class=" c-navi-new__medium-display-title">
                            پسرانه
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: دخترانه - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"دخترانه"}'
                            href="/search/category-girls-clothing/" class=" c-navi-new__big-display-title">
                            دخترانه
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"دخترانه"}'
                                 href="/search/category-girls-clothing/" class=" c-navi-new__medium-display-title">
                            دخترانه
                          </a>
                        </li>
                      </ul>
                    </div>
                    <div class="c-navi-new-list__options-list  js-mega-menu-category-options" id="categories-4">
                      <div class="c-navi-new-list__sublist-top-bar"><a href="/main/mother-and-child/"
                                                                       class="c-navi-new-list__sublist-see-all-cats">
                          همه دسته‌بندی‌های اسباب بازی و کودک
                        </a>
                      </div>
                      <ul>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--title"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en: Kids Apparel - category_fa: بهداشت و حمام کودک و نوزاد - level: 2">
                          <a data-snt-event="dkMegaMenuClick"
                             data-snt-params='{"type":"option-title","category_title":"بهداشت و حمام کودک و نوزاد"}'
                             href="/search/category-health-and-bathroom-tools/"
                             class=" c-navi-new__big-display-title"><span>بهداشت و حمام کودک و نوزاد</span></a><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"بهداشت و حمام کودک و نوزاد"}'
                            href="/search/category-health-and-bathroom-tools/"
                            class=" c-navi-new__medium-display-title"><span>بهداشت و حمام کودک و نوزاد</span></a></li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: پوشک - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"پوشک"}'
                            href="/search/category-diaper/" class=" c-navi-new__big-display-title">
                            پوشک
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"پوشک"}'
                                 href="/search/category-diaper/" class=" c-navi-new__medium-display-title">
                            پوشک
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: دستمال مرطوب - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"دستمال مرطوب"}'
                            href="/search/category-wet-wipes/" class=" c-navi-new__big-display-title">
                            دستمال مرطوب
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"دستمال مرطوب"}'
                                 href="/search/category-wet-wipes/" class=" c-navi-new__medium-display-title">
                            دستمال مرطوب
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: حوله - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"حوله"}'
                            href="/search/category-baby-towel/" class=" c-navi-new__big-display-title">
                            حوله
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"حوله"}'
                                 href="/search/category-baby-towel/" class=" c-navi-new__medium-display-title">
                            حوله
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: وان حمام نوزاد - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"وان حمام نوزاد"}'
                            href="/search/category-baby-bath-tub/" class=" c-navi-new__big-display-title">
                            وان حمام نوزاد
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"وان حمام نوزاد"}'
                                 href="/search/category-baby-bath-tub/" class=" c-navi-new__medium-display-title">
                            وان حمام نوزاد
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: مینی واش - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"مینی واش"}'
                            href="/search/category-diaper-cleaner/" class=" c-navi-new__big-display-title">
                            مینی واش
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"مینی واش"}'
                                 href="/search/category-diaper-cleaner/" class=" c-navi-new__medium-display-title">
                            مینی واش
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: شامپو کودک و نوزاد - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"شامپو کودک و نوزاد"}'
                            href="/search/category-baby-shampoo/" class=" c-navi-new__big-display-title">
                            شامپو کودک و نوزاد
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"شامپو کودک و نوزاد"}'
                                 href="/search/category-baby-shampoo/" class=" c-navi-new__medium-display-title">
                            شامپو کودک و نوزاد
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--title"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: پوشاک و کفش کودک و نوزاد - level: 2"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"پوشاک و کفش کودک و نوزاد"}'
                            href="/search/category-kids-apparel/" class=" c-navi-new__big-display-title"><span>پوشاک و کفش کودک و نوزاد</span></a><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"پوشاک و کفش کودک و نوزاد"}'
                            href="/search/category-kids-apparel/" class=" c-navi-new__medium-display-title"><span>پوشاک و کفش کودک و نوزاد</span></a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: لباس کودک و لباس نوزادی - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"لباس کودک و لباس نوزادی"}'
                            href="/search/category-children-and-baby-clothes/" class=" c-navi-new__big-display-title">
                            لباس کودک و لباس نوزادی
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"لباس کودک و لباس نوزادی"}'
                                 href="/search/category-children-and-baby-clothes/"
                                 class=" c-navi-new__medium-display-title">
                            لباس کودک و لباس نوزادی
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: کفش  - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"کفش "}'
                            href="/search/category-kidsshoes/" class=" c-navi-new__big-display-title">
                            کفش
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"کفش "}'
                                 href="/search/category-kidsshoes/" class=" c-navi-new__medium-display-title">
                            کفش
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: کفش ورزشی - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"کفش ورزشی"}'
                            href="/search/category-kids-sport-shoes/" class=" c-navi-new__big-display-title">
                            کفش ورزشی
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"کفش ورزشی"}'
                                 href="/search/category-kids-sport-shoes/" class=" c-navi-new__medium-display-title">
                            کفش ورزشی
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: جوراب و پاپوش کودک و نوزاد - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"جوراب و پاپوش کودک و نوزاد"}'
                            href="/search/category-kids-socks-/" class=" c-navi-new__big-display-title">
                            جوراب و پاپوش کودک و نوزاد
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"جوراب و پاپوش کودک و نوزاد"}'
                                 href="/search/category-kids-socks-/" class=" c-navi-new__medium-display-title">
                            جوراب و پاپوش کودک و نوزاد
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: کلاه و پیشبند نوزاد - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"کلاه و پیشبند نوزاد"}'
                            href="/search/category-hat-and-bib/" class=" c-navi-new__big-display-title">
                            کلاه و پیشبند نوزاد
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"کلاه و پیشبند نوزاد"}'
                                 href="/search/category-hat-and-bib/" class=" c-navi-new__medium-display-title">
                            کلاه و پیشبند نوزاد
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--title"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: تبلت - level: 2"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"تبلت"}'
                            href="/search/category-tablet/" class=" c-navi-new__big-display-title"><span>تبلت</span></a><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"تبلت"}'
                            href="/search/category-tablet/" class=" c-navi-new__medium-display-title"><span>تبلت</span></a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--title"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: XBox, PS4 و بازی - level: 2"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"XBox, PS4 و بازی"}'
                            href="/search/category-game-console/" class=" c-navi-new__big-display-title"><span>XBox, PS4 و بازی</span></a><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"XBox, PS4 و بازی"}'
                            href="/search/category-game-console/" class=" c-navi-new__medium-display-title"><span>XBox, PS4 و بازی</span></a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--title"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en: Dining Accessories - category_fa: اسباب بازی - level: 2"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"اسباب بازی"}'
                            href="/search/category-toys/" class=" c-navi-new__big-display-title"><span>اسباب بازی</span></a><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"اسباب بازی"}'
                            href="/search/category-toys/"
                            class=" c-navi-new__medium-display-title"><span>اسباب بازی</span></a></li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: فکری و آموزشی - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"فکری و آموزشی"}'
                            href="/search/category-intellectual-and-educational/"
                            class=" c-navi-new__big-display-title">
                            فکری و آموزشی
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"فکری و آموزشی"}'
                                 href="/search/category-intellectual-and-educational/"
                                 class=" c-navi-new__medium-display-title">
                            فکری و آموزشی
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: پازل، لگو و ساختنی - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"پازل، لگو و ساختنی"}'
                            href="/search/category-puzzles-and-building/" class=" c-navi-new__big-display-title">
                            پازل، لگو و ساختنی
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"پازل، لگو و ساختنی"}'
                                 href="/search/category-puzzles-and-building/"
                                 class=" c-navi-new__medium-display-title">
                            پازل، لگو و ساختنی
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: عروسک و فیگور - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"عروسک و فیگور"}'
                            href="/search/category-toy-and-model/" class=" c-navi-new__big-display-title">
                            عروسک و فیگور
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"عروسک و فیگور"}'
                                 href="/search/category-toy-and-model/" class=" c-navi-new__medium-display-title">
                            عروسک و فیگور
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: اسپینر، ابزار شوخی و سرگرمی - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"اسپینر، ابزار شوخی و سرگرمی"}'
                            href="/search/category-humor-and-entertainment/" class=" c-navi-new__big-display-title">
                            اسپینر، ابزار شوخی و سرگرمی
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"اسپینر، ابزار شوخی و سرگرمی"}'
                                 href="/search/category-humor-and-entertainment/"
                                 class=" c-navi-new__medium-display-title">
                            اسپینر، ابزار شوخی و سرگرمی
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: تفنگ، تیر و لوازم بازی جنگی - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"تفنگ، تیر و لوازم بازی جنگی"}'
                            href="/search/category-guns-and-combat/" class=" c-navi-new__big-display-title">
                            تفنگ، تیر و لوازم بازی جنگی
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"تفنگ، تیر و لوازم بازی جنگی"}'
                                 href="/search/category-guns-and-combat/" class=" c-navi-new__medium-display-title">
                            تفنگ، تیر و لوازم بازی جنگی
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--title"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en: Educational Equipment  - category_fa: بازی و سرگرمی کودک - level: 2">
                          <a data-snt-event="dkMegaMenuClick"
                             data-snt-params='{"type":"option-title","category_title":"بازی و سرگرمی کودک"}'
                             href="/search/category-entertainment-and-games-equipment/"
                             class=" c-navi-new__big-display-title"><span>بازی و سرگرمی کودک</span></a><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"بازی و سرگرمی کودک"}'
                            href="/search/category-entertainment-and-games-equipment/"
                            class=" c-navi-new__medium-display-title"><span>بازی و سرگرمی کودک</span></a></li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: ماشین بازی، موتور، سه چرخه - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"ماشین بازی، موتور، سه چرخه"}'
                            href="/search/category-tricycle-and-motorcycle/" class=" c-navi-new__big-display-title">
                            ماشین بازی، موتور، سه چرخه
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"ماشین بازی، موتور، سه چرخه"}'
                                 href="/search/category-tricycle-and-motorcycle/"
                                 class=" c-navi-new__medium-display-title">
                            ماشین بازی، موتور، سه چرخه
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: دوچرخه - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"دوچرخه"}'
                            href="/search/category-bicycles/" class=" c-navi-new__big-display-title">
                            دوچرخه
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"دوچرخه"}'
                                 href="/search/category-bicycles/" class=" c-navi-new__medium-display-title">
                            دوچرخه
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: تشک بازی و پارک بازی - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"تشک بازی و پارک بازی"}'
                            href="/search/category-play-gym/" class=" c-navi-new__big-display-title">
                            تشک بازی و پارک بازی
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"تشک بازی و پارک بازی"}'
                                 href="/search/category-play-gym/" class=" c-navi-new__medium-display-title">
                            تشک بازی و پارک بازی
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: تاب و سرسره - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"تاب و سرسره"}'
                            href="/search/category-swings-and-slides/" class=" c-navi-new__big-display-title">
                            تاب و سرسره
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"تاب و سرسره"}'
                                 href="/search/category-swings-and-slides/" class=" c-navi-new__medium-display-title">
                            تاب و سرسره
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--title"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: سلامت، ایمنی و مراقبت - level: 2"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"سلامت، ایمنی و مراقبت"}'
                            href="/search/category-safety-and-care/" class=" c-navi-new__big-display-title"><span>سلامت، ایمنی و مراقبت</span></a><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"سلامت، ایمنی و مراقبت"}'
                            href="/search/category-safety-and-care/" class=" c-navi-new__medium-display-title"><span>سلامت، ایمنی و مراقبت</span></a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: تصفیه هوا - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"تصفیه هوا"}'
                            href="/search/category-air-purifier/" class=" c-navi-new__big-display-title">
                            تصفیه هوا
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"تصفیه هوا"}'
                                 href="/search/category-air-purifier/" class=" c-navi-new__medium-display-title">
                            تصفیه هوا
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: ترازو - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"ترازو"}'
                            href="/search/category-digital-scale/" class=" c-navi-new__big-display-title">
                            ترازو
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"ترازو"}'
                                 href="/search/category-digital-scale/" class=" c-navi-new__medium-display-title">
                            ترازو
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: دوربین و پیجر اتاق کودک - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"دوربین و پیجر اتاق کودک"}'
                            href="/search/category-baby-monitor-and-pager/" class=" c-navi-new__big-display-title">
                            دوربین و پیجر اتاق کودک
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"دوربین و پیجر اتاق کودک"}'
                                 href="/search/category-baby-monitor-and-pager/"
                                 class=" c-navi-new__medium-display-title">
                            دوربین و پیجر اتاق کودک
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: تب سنج و دماسنج - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"تب سنج و دماسنج"}'
                            href="/search/category-baby-thermometer/" class=" c-navi-new__big-display-title">
                            تب سنج و دماسنج
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"تب سنج و دماسنج"}'
                                 href="/search/category-baby-thermometer/" class=" c-navi-new__medium-display-title">
                            تب سنج و دماسنج
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: محافظ و ابزار ایمنی - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"محافظ و ابزار ایمنی"}'
                            href="/search/category-safety-tools-for-children-and-babies/"
                            class=" c-navi-new__big-display-title">
                            محافظ و ابزار ایمنی
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"محافظ و ابزار ایمنی"}'
                                 href="/search/category-safety-tools-for-children-and-babies/"
                                 class=" c-navi-new__medium-display-title">
                            محافظ و ابزار ایمنی
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--title"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en: Kid bedroom &  - category_fa: خواب کودک - level: 2"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"خواب کودک"}'
                            href="/search/category-baby-bedding/"
                            class=" c-navi-new__big-display-title"><span>خواب کودک</span></a><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"خواب کودک"}'
                            href="/search/category-baby-bedding/" class=" c-navi-new__medium-display-title"><span>خواب کودک</span></a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: مبلمان اتاق کودک - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"مبلمان اتاق کودک"}'
                            href="/search/category-childrens-bedroom-furniture/" class=" c-navi-new__big-display-title">
                            مبلمان اتاق کودک
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"مبلمان اتاق کودک"}'
                                 href="/search/category-childrens-bedroom-furniture/"
                                 class=" c-navi-new__medium-display-title">
                            مبلمان اتاق کودک
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: چراغ خواب کودک - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"چراغ خواب کودک"}'
                            href="/search/category-baby-decorative-lamp/" class=" c-navi-new__big-display-title">
                            چراغ خواب کودک
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"چراغ خواب کودک"}'
                                 href="/search/category-baby-decorative-lamp/"
                                 class=" c-navi-new__medium-display-title">
                            چراغ خواب کودک
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: تشک کودک - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"تشک کودک"}'
                            href="/search/category-baby-mat/" class=" c-navi-new__big-display-title">
                            تشک کودک
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"تشک کودک"}'
                                 href="/search/category-baby-mat/" class=" c-navi-new__medium-display-title">
                            تشک کودک
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: سرویس خواب - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"سرویس خواب"}'
                            href="/search/category-bed-set/" class=" c-navi-new__big-display-title">
                            سرویس خواب
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"سرویس خواب"}'
                                 href="/search/category-bed-set/" class=" c-navi-new__medium-display-title">
                            سرویس خواب
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: پتو - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"پتو"}'
                            href="/search/category-blanket/" class=" c-navi-new__big-display-title">
                            پتو
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"پتو"}'
                                 href="/search/category-blanket/" class=" c-navi-new__medium-display-title">
                            پتو
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: بالش شیردهی - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"بالش شیردهی"}'
                            href="/search/category-feeding-pillow/" class=" c-navi-new__big-display-title">
                            بالش شیردهی
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"بالش شیردهی"}'
                                 href="/search/category-feeding-pillow/" class=" c-navi-new__medium-display-title">
                            بالش شیردهی
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--title"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en: Entertainment & Toys - category_fa: ملزومات گردش و سفر - level: 2">
                          <a data-snt-event="dkMegaMenuClick"
                             data-snt-params='{"type":"option-title","category_title":"ملزومات گردش و سفر"}'
                             href="/search/category-promenade-and-travel-accessories/"
                             class=" c-navi-new__big-display-title"><span>ملزومات گردش و سفر</span></a><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"ملزومات گردش و سفر"}'
                            href="/search/category-promenade-and-travel-accessories/"
                            class=" c-navi-new__medium-display-title"><span>ملزومات گردش و سفر</span></a></li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: کالسکه و کریر - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"کالسکه و کریر"}'
                            href="/search/category-stroller-and-carrier/" class=" c-navi-new__big-display-title">
                            کالسکه و کریر
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"کالسکه و کریر"}'
                                 href="/search/category-stroller-and-carrier/"
                                 class=" c-navi-new__medium-display-title">
                            کالسکه و کریر
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: صندلی خودرو کودک و نوزاد - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"صندلی خودرو کودک و نوزاد"}'
                            href="/search/category-chair-species/" class=" c-navi-new__big-display-title">
                            صندلی خودرو کودک و نوزاد
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"صندلی خودرو کودک و نوزاد"}'
                                 href="/search/category-chair-species/" class=" c-navi-new__medium-display-title">
                            صندلی خودرو کودک و نوزاد
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: ساک لوازم نوزاد - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"ساک لوازم نوزاد"}'
                            href="/search/category-diaper-bag/" class=" c-navi-new__big-display-title">
                            ساک لوازم نوزاد
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"ساک لوازم نوزاد"}'
                                 href="/search/category-diaper-bag/" class=" c-navi-new__medium-display-title">
                            ساک لوازم نوزاد
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: لوازم جانبی گردش و سفر - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"لوازم جانبی گردش و سفر"}'
                            href="/search/category-children-and-baby-promenade-and-travel-accessories/"
                            class=" c-navi-new__big-display-title">
                            لوازم جانبی گردش و سفر
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"لوازم جانبی گردش و سفر"}'
                                 href="/search/category-children-and-baby-promenade-and-travel-accessories/"
                                 class=" c-navi-new__medium-display-title">
                            لوازم جانبی گردش و سفر
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: آغوشی - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"آغوشی"}'
                            href="/search/category-baby-carrier/" class=" c-navi-new__big-display-title">
                            آغوشی
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"آغوشی"}'
                                 href="/search/category-baby-carrier/" class=" c-navi-new__medium-display-title">
                            آغوشی
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--title"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: لوازم شخصی - level: 2"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"لوازم شخصی"}'
                            href="/search/category-personal-accessories/" class=" c-navi-new__big-display-title"><span>لوازم شخصی</span></a><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"لوازم شخصی"}'
                            href="/search/category-personal-accessories/"
                            class=" c-navi-new__medium-display-title"><span>لوازم شخصی</span></a></li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: پستانک و ملزومات - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"پستانک و ملزومات"}'
                            href="/search/category-pacifier-and-accessories/" class=" c-navi-new__big-display-title">
                            پستانک و ملزومات
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"پستانک و ملزومات"}'
                                 href="/search/category-pacifier-and-accessories/"
                                 class=" c-navi-new__medium-display-title">
                            پستانک و ملزومات
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: شیردوش - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"شیردوش"}'
                            href="/search/category-milking/" class=" c-navi-new__big-display-title">
                            شیردوش
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"شیردوش"}'
                                 href="/search/category-milking/" class=" c-navi-new__medium-display-title">
                            شیردوش
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: شورت آموزشی - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"شورت آموزشی"}'
                            href="/search/category-training-short/" class=" c-navi-new__big-display-title">
                            شورت آموزشی
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"شورت آموزشی"}'
                                 href="/search/category-training-short/" class=" c-navi-new__medium-display-title">
                            شورت آموزشی
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--title"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: غذاخوری - level: 2"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"غذاخوری"}'
                            href="/search/category-dining-accessories/" class=" c-navi-new__big-display-title"><span>غذاخوری</span></a><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"غذاخوری"}'
                            href="/search/category-dining-accessories/" class=" c-navi-new__medium-display-title"><span>غذاخوری</span></a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: صندلی غذاخوری - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"صندلی غذاخوری"}'
                            href="/search/category-booster-seat/" class=" c-navi-new__big-display-title">
                            صندلی غذاخوری
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"صندلی غذاخوری"}'
                                 href="/search/category-booster-seat/" class=" c-navi-new__medium-display-title">
                            صندلی غذاخوری
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: شیشه شیر، سرلاک، داروخوری - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"شیشه شیر، سرلاک، داروخوری"}'
                            href="/search/category-baby-bottle/" class=" c-navi-new__big-display-title">
                            شیشه شیر، سرلاک، داروخوری
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"شیشه شیر، سرلاک، داروخوری"}'
                                 href="/search/category-baby-bottle/" class=" c-navi-new__medium-display-title">
                            شیشه شیر، سرلاک، داروخوری
                          </a>
                        </li>
                      </ul>
                    </div>
                    <div class="c-navi-new-list__options-list  js-mega-menu-category-options" id="categories-5">
                      <div class="c-navi-new-list__sublist-top-bar"><a href="/main/food-beverage/"
                                                                       class="c-navi-new-list__sublist-see-all-cats">
                          همه دسته‌بندی‌های کالاهای سوپرمارکتی
                        </a>
                      </div>
                      <ul>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--title"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: کالای اساسی و خوار و بار - level: 2"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"کالای اساسی و خوار و بار"}'
                            href="/search/category-groceries/" class=" c-navi-new__big-display-title"><span>کالای اساسی و خوار و بار</span></a><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"کالای اساسی و خوار و بار"}'
                            href="/search/category-groceries/" class=" c-navi-new__medium-display-title"><span>کالای اساسی و خوار و بار</span></a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: نان - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"نان"}'
                            href="/search/category-bread/" class=" c-navi-new__big-display-title">
                            نان
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"نان"}'
                                 href="/search/category-bread/" class=" c-navi-new__medium-display-title">
                            نان
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: برنج - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"برنج"}'
                            href="/search/category-rice/" class=" c-navi-new__big-display-title">
                            برنج
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"برنج"}'
                                 href="/search/category-rice/" class=" c-navi-new__medium-display-title">
                            برنج
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: روغن - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"روغن"}'
                            href="/search/category-oil/" class=" c-navi-new__big-display-title">
                            روغن
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"روغن"}'
                                 href="/search/category-oil/" class=" c-navi-new__medium-display-title">
                            روغن
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: قند - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"قند"}'
                            href="/search/category-sugar-cube/" class=" c-navi-new__big-display-title">
                            قند
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"قند"}'
                                 href="/search/category-sugar-cube/" class=" c-navi-new__medium-display-title">
                            قند
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: شکر - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"شکر"}'
                            href="/search/category-sugar/" class=" c-navi-new__big-display-title">
                            شکر
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"شکر"}'
                                 href="/search/category-sugar/" class=" c-navi-new__medium-display-title">
                            شکر
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: سس - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"سس"}'
                            href="/search/category-sauce-dressing/" class=" c-navi-new__big-display-title">
                            سس
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"سس"}'
                                 href="/search/category-sauce-dressing/" class=" c-navi-new__medium-display-title">
                            سس
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: رب و کنسرو گوجه - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"رب و کنسرو گوجه"}'
                            href="/search/category-tomato-paste/" class=" c-navi-new__big-display-title">
                            رب و کنسرو گوجه
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"رب و کنسرو گوجه"}'
                                 href="/search/category-tomato-paste/" class=" c-navi-new__medium-display-title">
                            رب و کنسرو گوجه
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: خیارشور و ترشیجات - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"خیارشور و ترشیجات"}'
                            href="/search/category-salted-marzipan/" class=" c-navi-new__big-display-title">
                            خیارشور و ترشیجات
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"خیارشور و ترشیجات"}'
                                 href="/search/category-salted-marzipan/" class=" c-navi-new__medium-display-title">
                            خیارشور و ترشیجات
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: آبلیمو، آبغوره و سرکه - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"آبلیمو، آبغوره و سرکه"}'
                            href="/search/category-liquid-condiments/" class=" c-navi-new__big-display-title">
                            آبلیمو، آبغوره و سرکه
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"آبلیمو، آبغوره و سرکه"}'
                                 href="/search/category-liquid-condiments/" class=" c-navi-new__medium-display-title">
                            آبلیمو، آبغوره و سرکه
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: ماکارونی، پاستا و رشته - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"ماکارونی، پاستا و رشته"}'
                            href="/search/category-spaghetti-pasta/" class=" c-navi-new__big-display-title">
                            ماکارونی، پاستا و رشته
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"ماکارونی، پاستا و رشته"}'
                                 href="/search/category-spaghetti-pasta/" class=" c-navi-new__medium-display-title">
                            ماکارونی، پاستا و رشته
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: زعفران، زرشک و تزیینات غذا - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"زعفران، زرشک و تزیینات غذا"}'
                            href="/search/category-food-design/" class=" c-navi-new__big-display-title">
                            زعفران، زرشک و تزیینات غذا
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"زعفران، زرشک و تزیینات غذا"}'
                                 href="/search/category-food-design/" class=" c-navi-new__medium-display-title">
                            زعفران، زرشک و تزیینات غذا
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: حبوبات و سویا - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"حبوبات و سویا"}'
                            href="/search/category-beans/" class=" c-navi-new__big-display-title">
                            حبوبات و سویا
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"حبوبات و سویا"}'
                                 href="/search/category-beans/" class=" c-navi-new__medium-display-title">
                            حبوبات و سویا
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--title"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: صبحانه - level: 2"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"صبحانه"}'
                            href="/search/category-breakfast/"
                            class=" c-navi-new__big-display-title"><span>صبحانه</span></a><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"صبحانه"}'
                            href="/search/category-breakfast/"
                            class=" c-navi-new__medium-display-title"><span>صبحانه</span></a></li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: مربا - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"مربا"}'
                            href="/search/category-jams-butter/" class=" c-navi-new__big-display-title">
                            مربا
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"مربا"}'
                                 href="/search/category-jams-butter/" class=" c-navi-new__medium-display-title">
                            مربا
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: عسل - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"عسل"}'
                            href="/search/category-honey/" class=" c-navi-new__big-display-title">
                            عسل
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"عسل"}'
                                 href="/search/category-honey/" class=" c-navi-new__medium-display-title">
                            عسل
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: حلواشکری، ارده و کنجد - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"حلواشکری، ارده و کنجد"}'
                            href="/search/category-halva-ardeh-sesame/" class=" c-navi-new__big-display-title">
                            حلواشکری، ارده و کنجد
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"حلواشکری، ارده و کنجد"}'
                                 href="/search/category-halva-ardeh-sesame/" class=" c-navi-new__medium-display-title">
                            حلواشکری، ارده و کنجد
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--title"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: مواد پروتئینی - level: 2"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"مواد پروتئینی"}'
                            href="/search/category-protein-foods/" class=" c-navi-new__big-display-title"><span>مواد پروتئینی</span></a><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"مواد پروتئینی"}'
                            href="/search/category-protein-foods/" class=" c-navi-new__medium-display-title"><span>مواد پروتئینی</span></a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: سوسیس و کالباس - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"سوسیس و کالباس"}'
                            href="/search/category-sausages/" class=" c-navi-new__big-display-title">
                            سوسیس و کالباس
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"سوسیس و کالباس"}'
                                 href="/search/category-sausages/" class=" c-navi-new__medium-display-title">
                            سوسیس و کالباس
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: گوشت گوسفندی - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"گوشت گوسفندی"}'
                            href="/search/category-sheep-meat/" class=" c-navi-new__big-display-title">
                            گوشت گوسفندی
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"گوشت گوسفندی"}'
                                 href="/search/category-sheep-meat/" class=" c-navi-new__medium-display-title">
                            گوشت گوسفندی
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: گوشت مرغ - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"گوشت مرغ"}'
                            href="/search/category-chicken/" class=" c-navi-new__big-display-title">
                            گوشت مرغ
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"گوشت مرغ"}'
                                 href="/search/category-chicken/" class=" c-navi-new__medium-display-title">
                            گوشت مرغ
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: تخم مرغ - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"تخم مرغ"}'
                            href="/search/category-eggs/" class=" c-navi-new__big-display-title">
                            تخم مرغ
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"تخم مرغ"}'
                                 href="/search/category-eggs/" class=" c-navi-new__medium-display-title">
                            تخم مرغ
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: گوشت گاو و گوساله - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"گوشت گاو و گوساله"}'
                            href="/search/category-beaf/" class=" c-navi-new__big-display-title">
                            گوشت گاو و گوساله
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"گوشت گاو و گوساله"}'
                                 href="/search/category-beaf/" class=" c-navi-new__medium-display-title">
                            گوشت گاو و گوساله
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: میگو - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"میگو"}'
                            href="/search/category-shrimp/" class=" c-navi-new__big-display-title">
                            میگو
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"میگو"}'
                                 href="/search/category-shrimp/" class=" c-navi-new__medium-display-title">
                            میگو
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: ماهی - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"ماهی"}'
                            href="/search/category-fish/" class=" c-navi-new__big-display-title">
                            ماهی
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"ماهی"}'
                                 href="/search/category-fish/" class=" c-navi-new__medium-display-title">
                            ماهی
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: تن ماهی - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"تن ماهی"}'
                            href="/search/category-tuna-fish/" class=" c-navi-new__big-display-title">
                            تن ماهی
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"تن ماهی"}'
                                 href="/search/category-tuna-fish/" class=" c-navi-new__medium-display-title">
                            تن ماهی
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--title"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: لبنیات - level: 2"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"لبنیات"}'
                            href="/search/category-dairy/"
                            class=" c-navi-new__big-display-title"><span>لبنیات</span></a><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"لبنیات"}'
                            href="/search/category-dairy/" class=" c-navi-new__medium-display-title"><span>لبنیات</span></a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: شیر - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"شیر"}'
                            href="/search/category-milk/" class=" c-navi-new__big-display-title">
                            شیر
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"شیر"}'
                                 href="/search/category-milk/" class=" c-navi-new__medium-display-title">
                            شیر
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: ماست - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"ماست"}'
                            href="/search/category-yogurt/" class=" c-navi-new__big-display-title">
                            ماست
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"ماست"}'
                                 href="/search/category-yogurt/" class=" c-navi-new__medium-display-title">
                            ماست
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: پنیر - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"پنیر"}'
                            href="/search/category-cheese/" class=" c-navi-new__big-display-title">
                            پنیر
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"پنیر"}'
                                 href="/search/category-cheese/" class=" c-navi-new__medium-display-title">
                            پنیر
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: خامه - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"خامه"}'
                            href="/search/category-cream/" class=" c-navi-new__big-display-title">
                            خامه
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"خامه"}'
                                 href="/search/category-cream/" class=" c-navi-new__medium-display-title">
                            خامه
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--title"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: نوشیدنی ها - level: 2"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"نوشیدنی ها"}'
                            href="/search/category-beverages/"
                            class=" c-navi-new__big-display-title"><span>نوشیدنی ها</span></a><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"نوشیدنی ها"}'
                            href="/search/category-beverages/" class=" c-navi-new__medium-display-title"><span>نوشیدنی ها</span></a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: چای - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"چای"}'
                            href="/search/category-tea/" class=" c-navi-new__big-display-title">
                            چای
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"چای"}'
                                 href="/search/category-tea/" class=" c-navi-new__medium-display-title">
                            چای
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: دمنوش - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"دمنوش"}'
                            href="/search/category-herbal-tea/" class=" c-navi-new__big-display-title">
                            دمنوش
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"دمنوش"}'
                                 href="/search/category-herbal-tea/" class=" c-navi-new__medium-display-title">
                            دمنوش
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: قهوه - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"قهوه"}'
                            href="/search/category-coffee" class=" c-navi-new__big-display-title">
                            قهوه
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"قهوه"}'
                                 href="/search/category-coffee" class=" c-navi-new__medium-display-title">
                            قهوه
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: آب و آب معدنی - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"آب و آب معدنی"}'
                            href="/search/category-mineral-water/" class=" c-navi-new__big-display-title">
                            آب و آب معدنی
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"آب و آب معدنی"}'
                                 href="/search/category-mineral-water/" class=" c-navi-new__medium-display-title">
                            آب و آب معدنی
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: ماءالشعیر - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"ماءالشعیر"}'
                            href="/search/category-non-alcoholic/" class=" c-navi-new__big-display-title">
                            ماءالشعیر
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"ماءالشعیر"}'
                                 href="/search/category-non-alcoholic/" class=" c-navi-new__medium-display-title">
                            ماءالشعیر
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: نوشابه - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"نوشابه"}'
                            href="/search/category-soft-drink/" class=" c-navi-new__big-display-title">
                            نوشابه
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"نوشابه"}'
                                 href="/search/category-soft-drink/" class=" c-navi-new__medium-display-title">
                            نوشابه
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: شربت و آبمیوه - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"شربت و آبمیوه"}'
                            href="/search/category-fruit-juice/" class=" c-navi-new__big-display-title">
                            شربت و آبمیوه
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"شربت و آبمیوه"}'
                                 href="/search/category-fruit-juice/" class=" c-navi-new__medium-display-title">
                            شربت و آبمیوه
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--title"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: میوه و سبزی - level: 2"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"میوه و سبزی"}'
                            href="/search/category-fruits-and-vegetables/" class=" c-navi-new__big-display-title"><span>میوه و سبزی</span></a><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"میوه و سبزی"}'
                            href="/search/category-fruits-and-vegetables/"
                            class=" c-navi-new__medium-display-title"><span>میوه و سبزی</span></a></li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--title"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: غذای آماده و نودل - level: 2"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"غذای آماده و نودل"}'
                            href="/search/category-ready-made-canned-food/"
                            class=" c-navi-new__big-display-title"><span>غذای آماده و نودل</span></a><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"غذای آماده و نودل"}'
                            href="/search/category-ready-made-canned-food/"
                            class=" c-navi-new__medium-display-title"><span>غذای آماده و نودل</span></a></li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--title"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: فرآورده‌های منجمد - level: 2"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"فرآورده‌های منجمد"}'
                            href="/search/category-frozen-food/" class=" c-navi-new__big-display-title"><span>فرآورده‌های منجمد</span></a><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"فرآورده‌های منجمد"}'
                            href="/search/category-frozen-food/" class=" c-navi-new__medium-display-title"><span>فرآورده‌های منجمد</span></a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--title"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: کنسرو و کمپوت - level: 2"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"کنسرو و کمپوت"}'
                            href="/search/category-canned-food/" class=" c-navi-new__big-display-title"><span>کنسرو و کمپوت</span></a><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"کنسرو و کمپوت"}'
                            href="/search/category-canned-food/" class=" c-navi-new__medium-display-title"><span>کنسرو و کمپوت</span></a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--title"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: تنقلات - level: 2"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"تنقلات"}'
                            href="/search/category-snacks/"
                            class=" c-navi-new__big-display-title"><span>تنقلات</span></a><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"تنقلات"}'
                            href="/search/category-snacks/"
                            class=" c-navi-new__medium-display-title"><span>تنقلات</span></a></li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: شکلات، تافی و آبنبات - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"شکلات، تافی و آبنبات"}'
                            href="/search/category-chocolate/" class=" c-navi-new__big-display-title">
                            شکلات، تافی و آبنبات
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"شکلات، تافی و آبنبات"}'
                                 href="/search/category-chocolate/" class=" c-navi-new__medium-display-title">
                            شکلات، تافی و آبنبات
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: بیسکویت و ویفر - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"بیسکویت و ویفر"}'
                            href="/search/category-biscuits-wafers/" class=" c-navi-new__big-display-title">
                            بیسکویت و ویفر
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"بیسکویت و ویفر"}'
                                 href="/search/category-biscuits-wafers/" class=" c-navi-new__medium-display-title">
                            بیسکویت و ویفر
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: مغز طعم‌دار خشکبار - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"مغز طعم‌دار خشکبار"}'
                            href="/search/category-nuts-trail-mix/" class=" c-navi-new__big-display-title">
                            مغز طعم‌دار خشکبار
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"مغز طعم‌دار خشکبار"}'
                                 href="/search/category-nuts-trail-mix/" class=" c-navi-new__medium-display-title">
                            مغز طعم‌دار خشکبار
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: کیک و کلوچه - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"کیک و کلوچه"}'
                            href="/search/category-cookies/" class=" c-navi-new__big-display-title">
                            کیک و کلوچه
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"کیک و کلوچه"}'
                                 href="/search/category-cookies/" class=" c-navi-new__medium-display-title">
                            کیک و کلوچه
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: چیپس و پاپ کورن - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"چیپس و پاپ کورن"}'
                            href="/search/category-chips/" class=" c-navi-new__big-display-title">
                            چیپس و پاپ کورن
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"چیپس و پاپ کورن"}'
                                 href="/search/category-chips/" class=" c-navi-new__medium-display-title">
                            چیپس و پاپ کورن
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: پفک و اسنک - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"پفک و اسنک"}'
                            href="/search/category-cheese-puffs/" class=" c-navi-new__big-display-title">
                            پفک و اسنک
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"پفک و اسنک"}'
                                 href="/search/category-cheese-puffs/" class=" c-navi-new__medium-display-title">
                            پفک و اسنک
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: آدامس و خوشبوکننده - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"آدامس و خوشبوکننده"}'
                            href="/search/category-chewing-gum-breath-fresheners/"
                            class=" c-navi-new__big-display-title">
                            آدامس و خوشبوکننده
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"آدامس و خوشبوکننده"}'
                                 href="/search/category-chewing-gum-breath-fresheners/"
                                 class=" c-navi-new__medium-display-title">
                            آدامس و خوشبوکننده
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--title"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: خشکبار و شیرینی - level: 2"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"خشکبار و شیرینی"}'
                            href="/search/category-dried-fruit-nuts/" class=" c-navi-new__big-display-title"><span>خشکبار و شیرینی</span></a><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"خشکبار و شیرینی"}'
                            href="/search/category-dried-fruit-nuts/" class=" c-navi-new__medium-display-title"><span>خشکبار و شیرینی</span></a>
                        </li>
                      </ul>
                    </div>
                    <div class="c-navi-new-list__options-list  js-mega-menu-category-options" id="categories-6">
                      <div class="c-navi-new-list__sublist-top-bar"><a href="/main/personal-appliance/"
                                                                       class="c-navi-new-list__sublist-see-all-cats">
                          همه دسته‌بندی‌های آرایشی و بهداشتی
                        </a>
                      </div>
                      <ul>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--title"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en: Accessories  - category_fa: لوازم آرایشی - level: 2"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"لوازم آرایشی"}'
                            href="/search/category-beauty/"
                            class=" c-navi-new__big-display-title"><span>لوازم آرایشی</span></a><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"لوازم آرایشی"}'
                            href="/search/category-beauty/"
                            class=" c-navi-new__medium-display-title"><span>لوازم آرایشی</span></a></li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: آرایش چشم و ابرو - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"آرایش چشم و ابرو"}'
                            href="/search/category-eye-and-eyebrow/" class=" c-navi-new__big-display-title">
                            آرایش چشم و ابرو
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"آرایش چشم و ابرو"}'
                                 href="/search/category-eye-and-eyebrow/" class=" c-navi-new__medium-display-title">
                            آرایش چشم و ابرو
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: آرایش لب - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"آرایش لب"}'
                            href="/search/category-lip/" class=" c-navi-new__big-display-title">
                            آرایش لب
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"آرایش لب"}'
                                 href="/search/category-lip/" class=" c-navi-new__medium-display-title">
                            آرایش لب
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: آرایش صورت - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"آرایش صورت"}'
                            href="/search/category-face/" class=" c-navi-new__big-display-title">
                            آرایش صورت
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"آرایش صورت"}'
                                 href="/search/category-face/" class=" c-navi-new__medium-display-title">
                            آرایش صورت
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: مواد آرایش مو - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"مواد آرایش مو"}'
                            href="/search/category-hair-products/" class=" c-navi-new__big-display-title">
                            مواد آرایش مو
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"مواد آرایش مو"}'
                                 href="/search/category-hair-products/" class=" c-navi-new__medium-display-title">
                            مواد آرایش مو
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: سنگ پا، بهداشت و زیبایی ناخن - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"سنگ پا، بهداشت و زیبایی ناخن"}'
                            href="/search/category-nail-care/" class=" c-navi-new__big-display-title">
                            سنگ پا، بهداشت و زیبایی ناخن
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"سنگ پا، بهداشت و زیبایی ناخن"}'
                                 href="/search/category-nail-care/" class=" c-navi-new__medium-display-title">
                            سنگ پا، بهداشت و زیبایی ناخن
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: تجهیزات جانبی آرایشی - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"تجهیزات جانبی آرایشی"}'
                            href="/search/category-beauty-accesories/" class=" c-navi-new__big-display-title">
                            تجهیزات جانبی آرایشی
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"تجهیزات جانبی آرایشی"}'
                                 href="/search/category-beauty-accesories/" class=" c-navi-new__medium-display-title">
                            تجهیزات جانبی آرایشی
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--title"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en: Watches - category_fa: لوازم بهداشتی - level: 2"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"لوازم بهداشتی"}'
                            href="/search/category-personal-care/" class=" c-navi-new__big-display-title"><span>لوازم بهداشتی</span></a><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"لوازم بهداشتی"}'
                            href="/search/category-personal-care/" class=" c-navi-new__medium-display-title"><span>لوازم بهداشتی</span></a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: کرم و مراقبت پوست - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"کرم و مراقبت پوست"}'
                            href="/search/category-face-and-body-cream/" class=" c-navi-new__big-display-title">
                            کرم و مراقبت پوست
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"کرم و مراقبت پوست"}'
                                 href="/search/category-face-and-body-cream/" class=" c-navi-new__medium-display-title">
                            کرم و مراقبت پوست
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: شامپو و مراقبت مو - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"شامپو و مراقبت مو"}'
                            href="/search/category-hair-care/" class=" c-navi-new__big-display-title">
                            شامپو و مراقبت مو
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"شامپو و مراقبت مو"}'
                                 href="/search/category-hair-care/" class=" c-navi-new__medium-display-title">
                            شامپو و مراقبت مو
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: بهداشت دهان و دندان - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"بهداشت دهان و دندان"}'
                            href="/search/category-dental-hygienist/" class=" c-navi-new__big-display-title">
                            بهداشت دهان و دندان
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"بهداشت دهان و دندان"}'
                                 href="/search/category-dental-hygienist/" class=" c-navi-new__medium-display-title">
                            بهداشت دهان و دندان
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: بهداشت و مراقبت بدن - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"بهداشت و مراقبت بدن"}'
                            href="/search/category-body-care/" class=" c-navi-new__big-display-title">
                            بهداشت و مراقبت بدن
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"بهداشت و مراقبت بدن"}'
                                 href="/search/category-body-care/" class=" c-navi-new__medium-display-title">
                            بهداشت و مراقبت بدن
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: ضد تعریق - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"ضد تعریق"}'
                            href="/search/category-anti-sweat/" class=" c-navi-new__big-display-title">
                            ضد تعریق
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"ضد تعریق"}'
                                 href="/search/category-anti-sweat/" class=" c-navi-new__medium-display-title">
                            ضد تعریق
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--title"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: لوازم شخصی برقی - level: 2"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"لوازم شخصی برقی"}'
                            href="/search/category-electrical-personal-care/"
                            class=" c-navi-new__big-display-title"><span>لوازم شخصی برقی</span></a><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"لوازم شخصی برقی"}'
                            href="/search/category-electrical-personal-care/" class=" c-navi-new__medium-display-title"><span>لوازم شخصی برقی</span></a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: ماشین اصلاح صورت - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"ماشین اصلاح صورت"}'
                            href="/search/category-shaver/" class=" c-navi-new__big-display-title">
                            ماشین اصلاح صورت
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"ماشین اصلاح صورت"}'
                                 href="/search/category-shaver/" class=" c-navi-new__medium-display-title">
                            ماشین اصلاح صورت
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: ماشین اصلاح سر - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"ماشین اصلاح سر"}'
                            href="/search/category-hair-trimmer/" class=" c-navi-new__big-display-title">
                            ماشین اصلاح سر
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"ماشین اصلاح سر"}'
                                 href="/search/category-hair-trimmer/" class=" c-navi-new__medium-display-title">
                            ماشین اصلاح سر
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: سشوار - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"سشوار"}'
                            href="/search/category-hair-drier/" class=" c-navi-new__big-display-title">
                            سشوار
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"سشوار"}'
                                 href="/search/category-hair-drier/" class=" c-navi-new__medium-display-title">
                            سشوار
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: اصلاح بدن آقایان - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"اصلاح بدن آقایان"}'
                            href="/search/category-body-groom/" class=" c-navi-new__big-display-title">
                            اصلاح بدن آقایان
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"اصلاح بدن آقایان"}'
                                 href="/search/category-body-groom/" class=" c-navi-new__medium-display-title">
                            اصلاح بدن آقایان
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: اصلاح بدن بانوان - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"اصلاح بدن بانوان"}'
                            href="/search/category-epilator/" class=" c-navi-new__big-display-title">
                            اصلاح بدن بانوان
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"اصلاح بدن بانوان"}'
                                 href="/search/category-epilator/" class=" c-navi-new__medium-display-title">
                            اصلاح بدن بانوان
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: اصلاح موی گوش، بینی و ابرو - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"اصلاح موی گوش، بینی و ابرو"}'
                            href="/search/category-nose-clipping/" class=" c-navi-new__big-display-title">
                            اصلاح موی گوش، بینی و ابرو
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"اصلاح موی گوش، بینی و ابرو"}'
                                 href="/search/category-nose-clipping/" class=" c-navi-new__medium-display-title">
                            اصلاح موی گوش، بینی و ابرو
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: برس پاک سازی - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"برس پاک سازی"}'
                            href="/search/category-skin-care-accessories/" class=" c-navi-new__big-display-title">
                            برس پاک سازی
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"برس پاک سازی"}'
                                 href="/search/category-skin-care-accessories/"
                                 class=" c-navi-new__medium-display-title">
                            برس پاک سازی
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: اتو مو و حالت دهنده - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"اتو مو و حالت دهنده"}'
                            href="/search/category-hair-iron/" class=" c-navi-new__big-display-title">
                            اتو مو و حالت دهنده
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"اتو مو و حالت دهنده"}'
                                 href="/search/category-hair-iron/" class=" c-navi-new__medium-display-title">
                            اتو مو و حالت دهنده
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: بیگودی و فر کننده - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"بیگودی و فر کننده"}'
                            href="/search/category-hair-shaping/" class=" c-navi-new__big-display-title">
                            بیگودی و فر کننده
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"بیگودی و فر کننده"}'
                                 href="/search/category-hair-shaping/" class=" c-navi-new__medium-display-title">
                            بیگودی و فر کننده
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en: Tooth ‌Brush - category_fa: مسواک برقی - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"مسواک برقی"}'
                            href="/search/category-electric-brusher/" class=" c-navi-new__big-display-title">
                            مسواک برقی
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"مسواک برقی"}'
                                 href="/search/category-electric-brusher/" class=" c-navi-new__medium-display-title">
                            مسواک برقی
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: لیزر - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"لیزر"}'
                            href="/search/category-electrical-personal-care/?q=لیزر&entry=mm"
                            class=" c-navi-new__big-display-title">
                            لیزر
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"لیزر"}'
                                 href="/search/category-electrical-personal-care/?q=لیزر&entry=mm"
                                 class=" c-navi-new__medium-display-title">
                            لیزر
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--title"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: ست هدیه - level: 2"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"ست هدیه"}'
                            href="/search/category-gift-set/"
                            class=" c-navi-new__big-display-title"><span>ست هدیه</span></a><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"ست هدیه"}'
                            href="/search/category-gift-set/"
                            class=" c-navi-new__medium-display-title"><span>ست هدیه</span></a></li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--title"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: عطر، ادکلن، اسپری و ست - level: 2"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"عطر، ادکلن، اسپری و ست"}'
                            href="/search/category-perfume-all/" class=" c-navi-new__big-display-title"><span>عطر، ادکلن، اسپری و ست</span></a><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"عطر، ادکلن، اسپری و ست"}'
                            href="/search/category-perfume-all/" class=" c-navi-new__medium-display-title"><span>عطر، ادکلن، اسپری و ست</span></a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: مردانه - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"مردانه"}'
                            href="/search/category-perfume/?q=%d9%85%d8%b1%d8%af%d8%a7%d9%86%d9%87&entry=mm"
                            class=" c-navi-new__big-display-title">
                            مردانه
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"مردانه"}'
                                 href="/search/category-perfume/?q=%d9%85%d8%b1%d8%af%d8%a7%d9%86%d9%87&entry=mm"
                                 class=" c-navi-new__medium-display-title">
                            مردانه
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: زنانه - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"زنانه"}'
                            href="/search/category-perfume/?q=%d8%b2%d9%86%d8%a7%d9%86%d9%87&entry=mm"
                            class=" c-navi-new__big-display-title">
                            زنانه
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"زنانه"}'
                                 href="/search/category-perfume/?q=%d8%b2%d9%86%d8%a7%d9%86%d9%87&entry=mm"
                                 class=" c-navi-new__medium-display-title">
                            زنانه
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: جیبی - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"جیبی"}'
                            href="/search/category-pocket-perfumes/" class=" c-navi-new__big-display-title">
                            جیبی
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"جیبی"}'
                                 href="/search/category-pocket-perfumes/" class=" c-navi-new__medium-display-title">
                            جیبی
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: اسپری - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"اسپری"}'
                            href="/search/category-spray/" class=" c-navi-new__big-display-title">
                            اسپری
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"اسپری"}'
                                 href="/search/category-spray/" class=" c-navi-new__medium-display-title">
                            اسپری
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--title"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: طلا، نقره و زیورآلات زنانه - level: 2"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"طلا، نقره و زیورآلات زنانه"}'
                            href="/search/category-women-accessories/?q=%d8%b2%db%8c%d9%88%d8%b1%d8%a2%d9%84%d8%a7%d8%aa&entry=mm"
                            class=" c-navi-new__big-display-title"><span>طلا، نقره و زیورآلات زنانه</span></a><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"طلا، نقره و زیورآلات زنانه"}'
                            href="/search/category-women-accessories/?q=%d8%b2%db%8c%d9%88%d8%b1%d8%a2%d9%84%d8%a7%d8%aa&entry=mm"
                            class=" c-navi-new__medium-display-title"><span>طلا، نقره و زیورآلات زنانه</span></a></li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: زیورآلات نقره زنانه - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"زیورآلات نقره زنانه"}'
                            href="/search/category-women-silver-jewelry/" class=" c-navi-new__big-display-title">
                            زیورآلات نقره زنانه
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"زیورآلات نقره زنانه"}'
                                 href="/search/category-women-silver-jewelry/"
                                 class=" c-navi-new__medium-display-title">
                            زیورآلات نقره زنانه
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: زیورآلات طلا زنانه - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"زیورآلات طلا زنانه"}'
                            href="/search/category-women-gold-jewelry/" class=" c-navi-new__big-display-title">
                            زیورآلات طلا زنانه
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"زیورآلات طلا زنانه"}'
                                 href="/search/category-women-gold-jewelry/" class=" c-navi-new__medium-display-title">
                            زیورآلات طلا زنانه
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: حلقه و انگشتر طلای زنانه - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"حلقه و انگشتر طلای زنانه"}'
                            href="/search/category-women-gold-ring/" class=" c-navi-new__big-display-title">
                            حلقه و انگشتر طلای زنانه
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"حلقه و انگشتر طلای زنانه"}'
                                 href="/search/category-women-gold-ring/" class=" c-navi-new__medium-display-title">
                            حلقه و انگشتر طلای زنانه
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: دستبند طلا زنانه - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"دستبند طلا زنانه"}'
                            href="/search/category-women-gold-bracelet/" class=" c-navi-new__big-display-title">
                            دستبند طلا زنانه
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"دستبند طلا زنانه"}'
                                 href="/search/category-women-gold-bracelet/" class=" c-navi-new__medium-display-title">
                            دستبند طلا زنانه
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: گردنبند طلا زنانه - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"گردنبند طلا زنانه"}'
                            href="/search/category-women-gold-necklace/" class=" c-navi-new__big-display-title">
                            گردنبند طلا زنانه
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"گردنبند طلا زنانه"}'
                                 href="/search/category-women-gold-necklace/" class=" c-navi-new__medium-display-title">
                            گردنبند طلا زنانه
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: گوشواره طلا زنانه - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"گوشواره طلا زنانه"}'
                            href="/search/category-women-gold-earrings/" class=" c-navi-new__big-display-title">
                            گوشواره طلا زنانه
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"گوشواره طلا زنانه"}'
                                 href="/search/category-women-gold-earrings/" class=" c-navi-new__medium-display-title">
                            گوشواره طلا زنانه
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--title"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: زیورآلات نقره مردانه - level: 2"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"زیورآلات نقره مردانه"}'
                            href="/search/category-men-silver-jewelry/" class=" c-navi-new__big-display-title"><span>زیورآلات نقره مردانه</span></a><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"زیورآلات نقره مردانه"}'
                            href="/search/category-men-silver-jewelry/" class=" c-navi-new__medium-display-title"><span>زیورآلات نقره مردانه</span></a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--title"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: ابزار سلامت و طبی - level: 2"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"ابزار سلامت و طبی"}'
                            href="/search/category-health-care/" class=" c-navi-new__big-display-title"><span>ابزار سلامت و طبی</span></a><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"ابزار سلامت و طبی"}'
                            href="/search/category-health-care/" class=" c-navi-new__medium-display-title"><span>ابزار سلامت و طبی</span></a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: مچ بند و ساعت هوشمند - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"مچ بند و ساعت هوشمند"}'
                            href="/search/category-wearable-gadget/" class=" c-navi-new__big-display-title">
                            مچ بند و ساعت هوشمند
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"مچ بند و ساعت هوشمند"}'
                                 href="/search/category-wearable-gadget/" class=" c-navi-new__medium-display-title">
                            مچ بند و ساعت هوشمند
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: ترازو - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"ترازو"}'
                            href="/search/category-digital-scale/" class=" c-navi-new__big-display-title">
                            ترازو
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"ترازو"}'
                                 href="/search/category-digital-scale/" class=" c-navi-new__medium-display-title">
                            ترازو
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: کالای خواب و استراحت طبی - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"کالای خواب و استراحت طبی"}'
                            href="/search/category-%20sleep-and-rest-medical/" class=" c-navi-new__big-display-title">
                            کالای خواب و استراحت طبی
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"کالای خواب و استراحت طبی"}'
                                 href="/search/category-%20sleep-and-rest-medical/"
                                 class=" c-navi-new__medium-display-title">
                            کالای خواب و استراحت طبی
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: تست قند خون - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"تست قند خون"}'
                            href="/search/category-blood-sugar-meter/" class=" c-navi-new__big-display-title">
                            تست قند خون
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"تست قند خون"}'
                                 href="/search/category-blood-sugar-meter/" class=" c-navi-new__medium-display-title">
                            تست قند خون
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: تب سنج - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"تب سنج"}'
                            href="/search/category-thermometers/" class=" c-navi-new__big-display-title">
                            تب سنج
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"تب سنج"}'
                                 href="/search/category-thermometers/" class=" c-navi-new__medium-display-title">
                            تب سنج
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: فشارسنج - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"فشارسنج"}'
                            href="/search/category-digital-sphygmomanometer/" class=" c-navi-new__big-display-title">
                            فشارسنج
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"فشارسنج"}'
                                 href="/search/category-digital-sphygmomanometer/"
                                 class=" c-navi-new__medium-display-title">
                            فشارسنج
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: ابزار مراقبت پا - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"ابزار مراقبت پا"}'
                            href="/search/category-heel-pads/" class=" c-navi-new__big-display-title">
                            ابزار مراقبت پا
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"ابزار مراقبت پا"}'
                                 href="/search/category-heel-pads/" class=" c-navi-new__medium-display-title">
                            ابزار مراقبت پا
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: نمایشگر ضربان قلب - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"نمایشگر ضربان قلب"}'
                            href="/search/category-heart-monitor-/" class=" c-navi-new__big-display-title">
                            نمایشگر ضربان قلب
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"نمایشگر ضربان قلب"}'
                                 href="/search/category-heart-monitor-/" class=" c-navi-new__medium-display-title">
                            نمایشگر ضربان قلب
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: ماساژور - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"ماساژور"}'
                            href="/search/category-massager/" class=" c-navi-new__big-display-title">
                            ماساژور
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"ماساژور"}'
                                 href="/search/category-massager/" class=" c-navi-new__medium-display-title">
                            ماساژور
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: تشک و پتوی برقی - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"تشک و پتوی برقی"}'
                            href="/search/category-electric-underblankets-and-blanket/"
                            class=" c-navi-new__big-display-title">
                            تشک و پتوی برقی
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"تشک و پتوی برقی"}'
                                 href="/search/category-electric-underblankets-and-blanket/"
                                 class=" c-navi-new__medium-display-title">
                            تشک و پتوی برقی
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: ویلچر - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"ویلچر"}'
                            href="/search/category-wheelchair/" class=" c-navi-new__big-display-title">
                            ویلچر
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"ویلچر"}'
                                 href="/search/category-wheelchair/" class=" c-navi-new__medium-display-title">
                            ویلچر
                          </a>
                        </li>
                      </ul>
                    </div>
                    <div class="c-navi-new-list__options-list  js-mega-menu-category-options" id="categories-7">
                      <div class="c-navi-new-list__sublist-top-bar"><a href="/main/home-and-kitchen/"
                                                                       class="c-navi-new-list__sublist-see-all-cats">
                          همه دسته‌بندی‌های خانه، آشپزخانه و ابزار
                        </a>
                      </div>
                      <ul>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--title"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en: Home Audio & Video - category_fa: صوتی و تصویری - level: 2">
                          <a data-snt-event="dkMegaMenuClick"
                             data-snt-params='{"type":"option-title","category_title":"صوتی و تصویری"}'
                             href="/search/category-video-audio-entertainment/"
                             class=" c-navi-new__big-display-title"><span>صوتی و تصویری</span></a><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"صوتی و تصویری"}'
                            href="/search/category-video-audio-entertainment/"
                            class=" c-navi-new__medium-display-title"><span>صوتی و تصویری</span></a></li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: تلویزیون - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"تلویزیون"}'
                            href="/search/category-tv2/" class=" c-navi-new__big-display-title">
                            تلویزیون
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"تلویزیون"}'
                                 href="/search/category-tv2/" class=" c-navi-new__medium-display-title">
                            تلویزیون
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: سینمای خانگی و ساندبار - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"سینمای خانگی و ساندبار"}'
                            href="/search/category-home-theatre/" class=" c-navi-new__big-display-title">
                            سینمای خانگی و ساندبار
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"سینمای خانگی و ساندبار"}'
                                 href="/search/category-home-theatre/" class=" c-navi-new__medium-display-title">
                            سینمای خانگی و ساندبار
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: گیرنده دیجیتال تلویزیون - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"گیرنده دیجیتال تلویزیون"}'
                            href="/search/category-set-top-box/" class=" c-navi-new__big-display-title">
                            گیرنده دیجیتال تلویزیون
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"گیرنده دیجیتال تلویزیون"}'
                                 href="/search/category-set-top-box/" class=" c-navi-new__medium-display-title">
                            گیرنده دیجیتال تلویزیون
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--title"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: دکوراتیو - level: 2"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"دکوراتیو"}'
                            href="/search/category-decorative/"
                            class=" c-navi-new__big-display-title"><span>دکوراتیو</span></a><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"دکوراتیو"}'
                            href="/search/category-decorative/"
                            class=" c-navi-new__medium-display-title"><span>دکوراتیو</span></a></li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: مبلمان خانگی - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"مبلمان خانگی"}'
                            href="/search/category-household-furniture/" class=" c-navi-new__big-display-title">
                            مبلمان خانگی
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"مبلمان خانگی"}'
                                 href="/search/category-household-furniture/" class=" c-navi-new__medium-display-title">
                            مبلمان خانگی
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: دکوراسیون اداری - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"دکوراسیون اداری"}'
                            href="/search/category-office-furniture/" class=" c-navi-new__big-display-title">
                            دکوراسیون اداری
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"دکوراسیون اداری"}'
                                 href="/search/category-office-furniture/" class=" c-navi-new__medium-display-title">
                            دکوراسیون اداری
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: آینه - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"آینه"}'
                            href="/search/category-decorative-mirror/" class=" c-navi-new__big-display-title">
                            آینه
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"آینه"}'
                                 href="/search/category-decorative-mirror/" class=" c-navi-new__medium-display-title">
                            آینه
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: پرده - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"پرده"}'
                            href="/search/category-curtain/" class=" c-navi-new__big-display-title">
                            پرده
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"پرده"}'
                                 href="/search/category-curtain/" class=" c-navi-new__medium-display-title">
                            پرده
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: تابلو - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"تابلو"}'
                            href="/search/category-decorative-board/" class=" c-navi-new__big-display-title">
                            تابلو
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"تابلو"}'
                                 href="/search/category-decorative-board/" class=" c-navi-new__medium-display-title">
                            تابلو
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: ساعت دیواری و رومیزی - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"ساعت دیواری و رومیزی"}'
                            href="/search/category-clocks/" class=" c-navi-new__big-display-title">
                            ساعت دیواری و رومیزی
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"ساعت دیواری و رومیزی"}'
                                 href="/search/category-clocks/" class=" c-navi-new__medium-display-title">
                            ساعت دیواری و رومیزی
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: شمع، گل و گلدان - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"شمع، گل و گلدان"}'
                            href="/search/category-decorative-ac/" class=" c-navi-new__big-display-title">
                            شمع، گل و گلدان
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"شمع، گل و گلدان"}'
                                 href="/search/category-decorative-ac/" class=" c-navi-new__medium-display-title">
                            شمع، گل و گلدان
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--title"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: فرش ماشینی، دستبافت، تابلو - level: 2"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"فرش ماشینی، دستبافت، تابلو"}'
                            href="/search/category-carpet/" class=" c-navi-new__big-display-title"><span>فرش ماشینی، دستبافت، تابلو</span></a><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"فرش ماشینی، دستبافت، تابلو"}'
                            href="/search/category-carpet/" class=" c-navi-new__medium-display-title"><span>فرش ماشینی، دستبافت، تابلو</span></a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--title"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en: Non Electrical Tools - category_fa: لوازم برقی خانگی - level: 2">
                          <a data-snt-event="dkMegaMenuClick"
                             data-snt-params='{"type":"option-title","category_title":"لوازم برقی خانگی"}'
                             href="/search/category-home-appliance/" class=" c-navi-new__big-display-title"><span>لوازم برقی خانگی</span></a><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"لوازم برقی خانگی"}'
                            href="/search/category-home-appliance/" class=" c-navi-new__medium-display-title"><span>لوازم برقی خانگی</span></a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: یخچال و فریزر - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"یخچال و فریزر"}'
                            href="/search/category-refrigerator-freezer/" class=" c-navi-new__big-display-title">
                            یخچال و فریزر
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"یخچال و فریزر"}'
                                 href="/search/category-refrigerator-freezer/"
                                 class=" c-navi-new__medium-display-title">
                            یخچال و فریزر
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: ماشین لباسشویی - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"ماشین لباسشویی"}'
                            href="/search/category-washing-machines/" class=" c-navi-new__big-display-title">
                            ماشین لباسشویی
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"ماشین لباسشویی"}'
                                 href="/search/category-washing-machines/" class=" c-navi-new__medium-display-title">
                            ماشین لباسشویی
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: ماشین ظرفشویی - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"ماشین ظرفشویی"}'
                            href="/search/category-dishwasher/" class=" c-navi-new__big-display-title">
                            ماشین ظرفشویی
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"ماشین ظرفشویی"}'
                                 href="/search/category-dishwasher/" class=" c-navi-new__medium-display-title">
                            ماشین ظرفشویی
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: جاروبرقی - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"جاروبرقی"}'
                            href="/search/category-vaccum-cleaner/" class=" c-navi-new__big-display-title">
                            جاروبرقی
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"جاروبرقی"}'
                                 href="/search/category-vaccum-cleaner/" class=" c-navi-new__medium-display-title">
                            جاروبرقی
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: جارو شارژی - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"جارو شارژی"}'
                            href="/search/category-handheld-vaccum/" class=" c-navi-new__big-display-title">
                            جارو شارژی
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"جارو شارژی"}'
                                 href="/search/category-handheld-vaccum/" class=" c-navi-new__medium-display-title">
                            جارو شارژی
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: تلفن، بی سیم و سانترال - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"تلفن، بی سیم و سانترال"}'
                            href="/search/category-telephone/" class=" c-navi-new__big-display-title">
                            تلفن، بی سیم و سانترال
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"تلفن، بی سیم و سانترال"}'
                                 href="/search/category-telephone/" class=" c-navi-new__medium-display-title">
                            تلفن، بی سیم و سانترال
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: کولر، پنکه، تصفیه هوا - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"کولر، پنکه، تصفیه هوا"}'
                            href="/search/category-airtreatment/" class=" c-navi-new__big-display-title">
                            کولر، پنکه، تصفیه هوا
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"کولر، پنکه، تصفیه هوا"}'
                                 href="/search/category-airtreatment/" class=" c-navi-new__medium-display-title">
                            کولر، پنکه، تصفیه هوا
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: قهوه و چای ساز، آب میوه گیر - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"قهوه و چای ساز، آب میوه گیر"}'
                            href="/search/category-drink-maker/" class=" c-navi-new__big-display-title">
                            قهوه و چای ساز، آب میوه گیر
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"قهوه و چای ساز، آب میوه گیر"}'
                                 href="/search/category-drink-maker/" class=" c-navi-new__medium-display-title">
                            قهوه و چای ساز، آب میوه گیر
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: ترازوی آشپزخانه - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"ترازوی آشپزخانه"}'
                            href="/search/category-kitchen-weighing-scale/" class=" c-navi-new__big-display-title">
                            ترازوی آشپزخانه
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"ترازوی آشپزخانه"}'
                                 href="/search/category-kitchen-weighing-scale/"
                                 class=" c-navi-new__medium-display-title">
                            ترازوی آشپزخانه
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: اتو بخار و پرسی - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"اتو بخار و پرسی"}'
                            href="/search/category-iron/" class=" c-navi-new__big-display-title">
                            اتو بخار و پرسی
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"اتو بخار و پرسی"}'
                                 href="/search/category-iron/" class=" c-navi-new__medium-display-title">
                            اتو بخار و پرسی
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--title"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: حیوانات خانگی، غذا و لوازم - level: 2"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"حیوانات خانگی، غذا و لوازم"}'
                            href="/search/category-pet/" class=" c-navi-new__big-display-title"><span>حیوانات خانگی، غذا و لوازم</span></a><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"حیوانات خانگی، غذا و لوازم"}'
                            href="/search/category-pet/" class=" c-navi-new__medium-display-title"><span>حیوانات خانگی، غذا و لوازم</span></a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: آکواریوم، غذا و لوازم آبزیان - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"آکواریوم، غذا و لوازم آبزیان"}'
                            href="/search/category-aquaculture-equipment/" class=" c-navi-new__big-display-title">
                            آکواریوم، غذا و لوازم آبزیان
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"آکواریوم، غذا و لوازم آبزیان"}'
                                 href="/search/category-aquaculture-equipment/"
                                 class=" c-navi-new__medium-display-title">
                            آکواریوم، غذا و لوازم آبزیان
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--title"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en: Home & kitchen Appliances - category_fa: سرو و پذیرایی - level: 2">
                          <a data-snt-event="dkMegaMenuClick"
                             data-snt-params='{"type":"option-title","category_title":"سرو و پذیرایی"}'
                             href="/search/category-serving/"
                             class=" c-navi-new__big-display-title"><span>سرو و پذیرایی</span></a><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"سرو و پذیرایی"}'
                            href="/search/category-serving/" class=" c-navi-new__medium-display-title"><span>سرو و پذیرایی</span></a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: سرویس غذاخوری - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"سرویس غذاخوری"}'
                            href="/search/category-dinnerware-sets/" class=" c-navi-new__big-display-title">
                            سرویس غذاخوری
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"سرویس غذاخوری"}'
                                 href="/search/category-dinnerware-sets/" class=" c-navi-new__medium-display-title">
                            سرویس غذاخوری
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: قاشق، چنگال و کارد - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"قاشق، چنگال و کارد"}'
                            href="/search/category-forkandspoonnandknife/" class=" c-navi-new__big-display-title">
                            قاشق، چنگال و کارد
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"قاشق، چنگال و کارد"}'
                                 href="/search/category-forkandspoonnandknife/"
                                 class=" c-navi-new__medium-display-title">
                            قاشق، چنگال و کارد
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: پارچ، بطری، لیوان و ماگ - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"پارچ، بطری، لیوان و ماگ"}'
                            href="/search/category-mugandjugset/" class=" c-navi-new__big-display-title">
                            پارچ، بطری، لیوان و ماگ
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"پارچ، بطری، لیوان و ماگ"}'
                                 href="/search/category-mugandjugset/" class=" c-navi-new__medium-display-title">
                            پارچ، بطری، لیوان و ماگ
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: ظروف پذیرایی - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"ظروف پذیرایی"}'
                            href="/search/category-servingware/" class=" c-navi-new__big-display-title">
                            ظروف پذیرایی
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"ظروف پذیرایی"}'
                                 href="/search/category-servingware/" class=" c-navi-new__medium-display-title">
                            ظروف پذیرایی
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--title"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en: Home Appliance - category_fa: نور و روشنایی - level: 2"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"نور و روشنایی"}'
                            href="/search/category-lighting/"
                            class=" c-navi-new__big-display-title"><span>نور و روشنایی</span></a><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"نور و روشنایی"}'
                            href="/search/category-lighting/" class=" c-navi-new__medium-display-title"><span>نور و روشنایی</span></a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: لامپ، چراغ و ریسه - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"لامپ، چراغ و ریسه"}'
                            href="/search/category-lamp/" class=" c-navi-new__big-display-title">
                            لامپ، چراغ و ریسه
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"لامپ، چراغ و ریسه"}'
                                 href="/search/category-lamp/" class=" c-navi-new__medium-display-title">
                            لامپ، چراغ و ریسه
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: لوستر و چراغ تزیینی - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"لوستر و چراغ تزیینی"}'
                            href="/search/category-hanging-lamps/" class=" c-navi-new__big-display-title">
                            لوستر و چراغ تزیینی
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"لوستر و چراغ تزیینی"}'
                                 href="/search/category-hanging-lamps/" class=" c-navi-new__medium-display-title">
                            لوستر و چراغ تزیینی
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--title"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: آشپزخانه - level: 2"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"آشپزخانه"}'
                            href="/search/category-home-kitchen-appliances/"
                            class=" c-navi-new__big-display-title"><span>آشپزخانه</span></a><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"آشپزخانه"}'
                            href="/search/category-home-kitchen-appliances/"
                            class=" c-navi-new__medium-display-title"><span>آشپزخانه</span></a></li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: سرویس و ظروف پخت و پز - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"سرویس و ظروف پخت و پز"}'
                            href="/search/category-kitchen-appliances/" class=" c-navi-new__big-display-title">
                            سرویس و ظروف پخت و پز
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"سرویس و ظروف پخت و پز"}'
                                 href="/search/category-kitchen-appliances/" class=" c-navi-new__medium-display-title">
                            سرویس و ظروف پخت و پز
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: فلاسک و کلمن - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"فلاسک و کلمن"}'
                            href="/search/category-flasks/" class=" c-navi-new__big-display-title">
                            فلاسک و کلمن
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"فلاسک و کلمن"}'
                                 href="/search/category-flasks/" class=" c-navi-new__medium-display-title">
                            فلاسک و کلمن
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: کتری، قوری، لوازم سرو چای - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"کتری، قوری، لوازم سرو چای"}'
                            href="/search/category-kettleandteapot/" class=" c-navi-new__big-display-title">
                            کتری، قوری، لوازم سرو چای
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"کتری، قوری، لوازم سرو چای"}'
                                 href="/search/category-kettleandteapot/" class=" c-navi-new__medium-display-title">
                            کتری، قوری، لوازم سرو چای
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: ظروف یکبار مصرف - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"ظروف یکبار مصرف"}'
                            href="/search/category-disposablecontainer/" class=" c-navi-new__big-display-title">
                            ظروف یکبار مصرف
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"ظروف یکبار مصرف"}'
                                 href="/search/category-disposablecontainer/" class=" c-navi-new__medium-display-title">
                            ظروف یکبار مصرف
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--title"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: مواد شوینده - level: 2"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"مواد شوینده"}'
                            href="/search/category-detergents/"
                            class=" c-navi-new__big-display-title"><span>مواد شوینده</span></a><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"مواد شوینده"}'
                            href="/search/category-detergents/" class=" c-navi-new__medium-display-title"><span>مواد شوینده</span></a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: شوینده ظروف - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"شوینده ظروف"}'
                            href="/search/category-dishes-detergents/" class=" c-navi-new__big-display-title">
                            شوینده ظروف
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"شوینده ظروف"}'
                                 href="/search/category-dishes-detergents/" class=" c-navi-new__medium-display-title">
                            شوینده ظروف
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: شوینده لباس - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"شوینده لباس"}'
                            href="/search/category-clothes-detergents/" class=" c-navi-new__big-display-title">
                            شوینده لباس
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"شوینده لباس"}'
                                 href="/search/category-clothes-detergents/" class=" c-navi-new__medium-display-title">
                            شوینده لباس
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: تمیزکننده سطوح - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"تمیزکننده سطوح"}'
                            href="/search/category-surface-cleaner/" class=" c-navi-new__big-display-title">
                            تمیزکننده سطوح
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"تمیزکننده سطوح"}'
                                 href="/search/category-surface-cleaner/" class=" c-navi-new__medium-display-title">
                            تمیزکننده سطوح
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--title"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: دستمال کاغذی - level: 2"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"دستمال کاغذی"}'
                            href="/search/category-tissue-paper/" class=" c-navi-new__big-display-title"><span>دستمال کاغذی</span></a><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"دستمال کاغذی"}'
                            href="/search/category-tissue-paper/" class=" c-navi-new__medium-display-title"><span>دستمال کاغذی</span></a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--title"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: ملحفه، سرویس، لوازم خواب - level: 2"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"ملحفه، سرویس، لوازم خواب"}'
                            href="/search/category-sleeping/" class=" c-navi-new__big-display-title"><span>ملحفه، سرویس، لوازم خواب</span></a><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"ملحفه، سرویس، لوازم خواب"}'
                            href="/search/category-sleeping/" class=" c-navi-new__medium-display-title"><span>ملحفه، سرویس، لوازم خواب</span></a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--title"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: حوله و وسایل حمام - level: 2"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"حوله و وسایل حمام"}'
                            href="/search/category-bath/"
                            class=" c-navi-new__big-display-title"><span>حوله و وسایل حمام</span></a><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"حوله و وسایل حمام"}'
                            href="/search/category-bath/" class=" c-navi-new__medium-display-title"><span>حوله و وسایل حمام</span></a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--title"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: پادری، کمد، لوازم اتاق خواب - level: 2"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"پادری، کمد، لوازم اتاق خواب"}'
                            href="/search/category-bedroom/" class=" c-navi-new__big-display-title"><span>پادری، کمد، لوازم اتاق خواب</span></a><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"پادری، کمد، لوازم اتاق خواب"}'
                            href="/search/category-bedroom/" class=" c-navi-new__medium-display-title"><span>پادری، کمد، لوازم اتاق خواب</span></a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--title"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: لوازم دستشویی و روشویی - level: 2"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"لوازم دستشویی و روشویی"}'
                            href="/search/category-watercloset/" class=" c-navi-new__big-display-title"><span>لوازم دستشویی و روشویی</span></a><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"لوازم دستشویی و روشویی"}'
                            href="/search/category-watercloset/" class=" c-navi-new__medium-display-title"><span>لوازم دستشویی و روشویی</span></a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--title"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: فندک و لوازم جانبی - level: 2"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"فندک و لوازم جانبی"}'
                            href="/search/category-pesonal-appliance-accessories/"
                            class=" c-navi-new__big-display-title"><span>فندک و لوازم جانبی</span></a><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"فندک و لوازم جانبی"}'
                            href="/search/category-pesonal-appliance-accessories/"
                            class=" c-navi-new__medium-display-title"><span>فندک و لوازم جانبی</span></a></li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--title"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en: Dinnerware - category_fa: گُل، خاک، کود، لوازم باغبانی - level: 2">
                          <a data-snt-event="dkMegaMenuClick"
                             data-snt-params='{"type":"option-title","category_title":"گُل، خاک، کود، لوازم باغبانی"}'
                             href="/search/category-gardening-tools/" class=" c-navi-new__big-display-title"><span>گُل، خاک، کود، لوازم باغبانی</span></a><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"گُل، خاک، کود، لوازم باغبانی"}'
                            href="/search/category-gardening-tools/" class=" c-navi-new__medium-display-title"><span>گُل، خاک، کود، لوازم باغبانی</span></a>
                        </li>
                      </ul>
                    </div>
                    <div class="c-navi-new-list__options-list  js-mega-menu-category-options" id="categories-8">
                      <div class="c-navi-new-list__sublist-top-bar"><a href="/main/book-and-media/"
                                                                       class="c-navi-new-list__sublist-see-all-cats">
                          همه دسته‌بندی‌های کتاب، لوازم تحریر و هنر
                        </a>
                      </div>
                      <ul>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--title"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en: Book & Magazine - category_fa: کتاب و مجله - level: 2"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"کتاب و مجله"}'
                            href="/search/book-and-media/publication/" class=" c-navi-new__big-display-title"><span>کتاب و مجله</span></a><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"کتاب و مجله"}'
                            href="/search/book-and-media/publication/" class=" c-navi-new__medium-display-title"><span>کتاب و مجله</span></a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: کتاب چاپی - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"کتاب چاپی"}'
                            href="/search/category-book/" class=" c-navi-new__big-display-title">
                            کتاب چاپی
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"کتاب چاپی"}'
                                 href="/search/category-book/" class=" c-navi-new__medium-display-title">
                            کتاب چاپی
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: مجلات خارجی و داخلی - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"مجلات خارجی و داخلی"}'
                            href="/search/category-magazines/" class=" c-navi-new__big-display-title">
                            مجلات خارجی و داخلی
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"مجلات خارجی و داخلی"}'
                                 href="/search/category-magazines/" class=" c-navi-new__medium-display-title">
                            مجلات خارجی و داخلی
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--title"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: کتاب صوتی - level: 2"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"کتاب صوتی"}'
                            href="/search/category-audio-book/"
                            class=" c-navi-new__big-display-title"><span>کتاب صوتی</span></a><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"کتاب صوتی"}'
                            href="/search/category-audio-book/" class=" c-navi-new__medium-display-title"><span>کتاب صوتی</span></a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--title"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en: Software & Educational Content - category_fa: محتوای آموزشی - level: 2">
                          <a data-snt-event="dkMegaMenuClick"
                             data-snt-params='{"type":"option-title","category_title":"محتوای آموزشی"}'
                             href="/search/category-multimedia-training-pack/"
                             class=" c-navi-new__big-display-title"><span>محتوای آموزشی</span></a><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"محتوای آموزشی"}'
                            href="/search/category-multimedia-training-pack/" class=" c-navi-new__medium-display-title"><span>محتوای آموزشی</span></a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: آموزش موسیقی - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"آموزش موسیقی"}'
                            href="/search/category-music-training/" class=" c-navi-new__big-display-title">
                            آموزش موسیقی
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"آموزش موسیقی"}'
                                 href="/search/category-music-training/" class=" c-navi-new__medium-display-title">
                            آموزش موسیقی
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: آموزش ورزش و سرگرمی - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"آموزش ورزش و سرگرمی"}'
                            href="/search/category-sport-and-entertainment/" class=" c-navi-new__big-display-title">
                            آموزش ورزش و سرگرمی
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"آموزش ورزش و سرگرمی"}'
                                 href="/search/category-sport-and-entertainment/"
                                 class=" c-navi-new__medium-display-title">
                            آموزش ورزش و سرگرمی
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: آموزش زبان - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"آموزش زبان"}'
                            href="/search/category-language-learning-software/" class=" c-navi-new__big-display-title">
                            آموزش زبان
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"آموزش زبان"}'
                                 href="/search/category-language-learning-software/"
                                 class=" c-navi-new__medium-display-title">
                            آموزش زبان
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: آموزش نرم افزار و کامپیوتر - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"آموزش نرم افزار و کامپیوتر"}'
                            href="/search/category-software-computer/" class=" c-navi-new__big-display-title">
                            آموزش نرم افزار و کامپیوتر
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"آموزش نرم افزار و کامپیوتر"}'
                                 href="/search/category-software-computer/" class=" c-navi-new__medium-display-title">
                            آموزش نرم افزار و کامپیوتر
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--title"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: نرم افزار - level: 2"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"نرم افزار"}'
                            href="/search/category-software/"
                            class=" c-navi-new__big-display-title"><span>نرم افزار</span></a><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"نرم افزار"}'
                            href="/search/category-software/"
                            class=" c-navi-new__medium-display-title"><span>نرم افزار</span></a></li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--title"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en: Video Game - category_fa: بازی کنسول و کامپیوتر - level: 2">
                          <a data-snt-event="dkMegaMenuClick"
                             data-snt-params='{"type":"option-title","category_title":"بازی کنسول و کامپیوتر"}'
                             href="/search/category-game/" class=" c-navi-new__big-display-title"><span>بازی کنسول و کامپیوتر</span></a><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"بازی کنسول و کامپیوتر"}'
                            href="/search/category-game/" class=" c-navi-new__medium-display-title"><span>بازی کنسول و کامپیوتر</span></a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--title"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en: Music & Audio Content - category_fa: فیلم سینمایی، سریال و مستند - level: 2">
                          <a data-snt-event="dkMegaMenuClick"
                             data-snt-params='{"type":"option-title","category_title":"فیلم سینمایی، سریال و مستند"}'
                             href="/search/category-film-video-content/" class=" c-navi-new__big-display-title"><span>فیلم سینمایی، سریال و مستند</span></a><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"فیلم سینمایی، سریال و مستند"}'
                            href="/search/category-film-video-content/" class=" c-navi-new__medium-display-title"><span>فیلم سینمایی، سریال و مستند</span></a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--title"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en: Musical Instruments - category_fa: آلبوم موسیقی - level: 2">
                          <a data-snt-event="dkMegaMenuClick"
                             data-snt-params='{"type":"option-title","category_title":"آلبوم موسیقی"}'
                             href="/search/category-music-audio-content/" class=" c-navi-new__big-display-title"><span>آلبوم موسیقی</span></a><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"آلبوم موسیقی"}'
                            href="/search/category-music-audio-content/"
                            class=" c-navi-new__medium-display-title"><span>آلبوم موسیقی</span></a></li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--title"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en: Stationery - category_fa: لوازم التحریر - level: 2"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"لوازم التحریر"}'
                            href="/search/category-stationery/" class=" c-navi-new__big-display-title"><span>لوازم التحریر</span></a><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"لوازم التحریر"}'
                            href="/search/category-stationery/" class=" c-navi-new__medium-display-title"><span>لوازم التحریر</span></a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: لوازم اداری و اقلام مصرفی - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"لوازم اداری و اقلام مصرفی"}'
                            href="/search/category-office-supplies/" class=" c-navi-new__big-display-title">
                            لوازم اداری و اقلام مصرفی
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"لوازم اداری و اقلام مصرفی"}'
                                 href="/search/category-office-supplies/" class=" c-navi-new__medium-display-title">
                            لوازم اداری و اقلام مصرفی
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: کیف، کوله پشتی و جامدادی - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"کیف، کوله پشتی و جامدادی"}'
                            href="/search/category-bags-backpacks/" class=" c-navi-new__big-display-title">
                            کیف، کوله پشتی و جامدادی
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"کیف، کوله پشتی و جامدادی"}'
                                 href="/search/category-bags-backpacks/" class=" c-navi-new__medium-display-title">
                            کیف، کوله پشتی و جامدادی
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: چراغ مطالعه - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"چراغ مطالعه"}'
                            href="/search/category-light/" class=" c-navi-new__big-display-title">
                            چراغ مطالعه
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"چراغ مطالعه"}'
                                 href="/search/category-light/" class=" c-navi-new__medium-display-title">
                            چراغ مطالعه
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: کاغذ کادو، پاکت و کارت هدیه - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"کاغذ کادو، پاکت و کارت هدیه"}'
                            href="/search/category-gift-tools/" class=" c-navi-new__big-display-title">
                            کاغذ کادو، پاکت و کارت هدیه
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"کاغذ کادو، پاکت و کارت هدیه"}'
                                 href="/search/category-gift-tools/" class=" c-navi-new__medium-display-title">
                            کاغذ کادو، پاکت و کارت هدیه
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: نوشت افزار - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"نوشت افزار"}'
                            href="/search/category-stationery-sub/" class=" c-navi-new__big-display-title">
                            نوشت افزار
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"نوشت افزار"}'
                                 href="/search/category-stationery-sub/" class=" c-navi-new__medium-display-title">
                            نوشت افزار
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: دفتر و کاغذ - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"دفتر و کاغذ"}'
                            href="/search/category-paper-notebook/" class=" c-navi-new__big-display-title">
                            دفتر و کاغذ
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"دفتر و کاغذ"}'
                                 href="/search/category-paper-notebook/" class=" c-navi-new__medium-display-title">
                            دفتر و کاغذ
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: خودکار و روان نویس - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"خودکار و روان نویس"}'
                            href="/search/category-pen/" class=" c-navi-new__big-display-title">
                            خودکار و روان نویس
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"خودکار و روان نویس"}'
                                 href="/search/category-pen/" class=" c-navi-new__medium-display-title">
                            خودکار و روان نویس
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: ابزار نقاشی و رنگ آمیزی - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"ابزار نقاشی و رنگ آمیزی"}'
                            href="/search/category-drawing-painting-tools/" class=" c-navi-new__big-display-title">
                            ابزار نقاشی و رنگ آمیزی
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"ابزار نقاشی و رنگ آمیزی"}'
                                 href="/search/category-drawing-painting-tools/"
                                 class=" c-navi-new__medium-display-title">
                            ابزار نقاشی و رنگ آمیزی
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: میز تحریر - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"میز تحریر"}'
                            href="/search/category-writing-desk/" class=" c-navi-new__big-display-title">
                            میز تحریر
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"میز تحریر"}'
                                 href="/search/category-writing-desk/" class=" c-navi-new__medium-display-title">
                            میز تحریر
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: آلبوم عکس - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"آلبوم عکس"}'
                            href="/search/category-photo-box/" class=" c-navi-new__big-display-title">
                            آلبوم عکس
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"آلبوم عکس"}'
                                 href="/search/category-photo-box/" class=" c-navi-new__medium-display-title">
                            آلبوم عکس
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: کاغذ چاپ و پرینتر - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"کاغذ چاپ و پرینتر"}'
                            href="/search/category-paper/?type[0]=5072&page=1&last_filter=type&last_value=5072&sortby=4&entry=mm"
                            class=" c-navi-new__big-display-title">
                            کاغذ چاپ و پرینتر
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"کاغذ چاپ و پرینتر"}'
                                 href="/search/category-paper/?type[0]=5072&page=1&last_filter=type&last_value=5072&sortby=4&entry=mm"
                                 class=" c-navi-new__medium-display-title">
                            کاغذ چاپ و پرینتر
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: مداد و مداد رنگی - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"مداد و مداد رنگی"}'
                            href="/search/category-pencil/" class=" c-navi-new__big-display-title">
                            مداد و مداد رنگی
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"مداد و مداد رنگی"}'
                                 href="/search/category-pencil/" class=" c-navi-new__medium-display-title">
                            مداد و مداد رنگی
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--title"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: آلات موسیقی - level: 2"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"آلات موسیقی"}'
                            href="/search/category-musicalinstruments/" class=" c-navi-new__big-display-title"><span>آلات موسیقی</span></a><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"آلات موسیقی"}'
                            href="/search/category-musicalinstruments/" class=" c-navi-new__medium-display-title"><span>آلات موسیقی</span></a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: لوازم جانبی ادوات موسیقی - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"لوازم جانبی ادوات موسیقی"}'
                            href="/search/category-musicinstrumentsaccessories/" class=" c-navi-new__big-display-title">
                            لوازم جانبی ادوات موسیقی
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"لوازم جانبی ادوات موسیقی"}'
                                 href="/search/category-musicinstrumentsaccessories/"
                                 class=" c-navi-new__medium-display-title">
                            لوازم جانبی ادوات موسیقی
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: گیتار - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"گیتار"}'
                            href="/search/category-guitar/" class=" c-navi-new__big-display-title">
                            گیتار
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"گیتار"}'
                                 href="/search/category-guitar/" class=" c-navi-new__medium-display-title">
                            گیتار
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: کیبورد و ارگ - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"کیبورد و ارگ"}'
                            href="/search/category-keybord-organ/" class=" c-navi-new__big-display-title">
                            کیبورد و ارگ
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"کیبورد و ارگ"}'
                                 href="/search/category-keybord-organ/" class=" c-navi-new__medium-display-title">
                            کیبورد و ارگ
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: پیانو دیجیتال - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"پیانو دیجیتال"}'
                            href="/search/category-pianos/" class=" c-navi-new__big-display-title">
                            پیانو دیجیتال
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"پیانو دیجیتال"}'
                                 href="/search/category-pianos/" class=" c-navi-new__medium-display-title">
                            پیانو دیجیتال
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: درام، پرکاشن و دف - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"درام، پرکاشن و دف"}'
                            href="/search/category-percussion-instruments/" class=" c-navi-new__big-display-title">
                            درام، پرکاشن و دف
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"درام، پرکاشن و دف"}'
                                 href="/search/category-percussion-instruments/"
                                 class=" c-navi-new__medium-display-title">
                            درام، پرکاشن و دف
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: تجهیزات استودیویی - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"تجهیزات استودیویی"}'
                            href="/search/category-studio-equipment/" class=" c-navi-new__big-display-title">
                            تجهیزات استودیویی
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"تجهیزات استودیویی"}'
                                 href="/search/category-studio-equipment/" class=" c-navi-new__medium-display-title">
                            تجهیزات استودیویی
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: ویولن - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"ویولن"}'
                            href="/search/category-violin/" class=" c-navi-new__big-display-title">
                            ویولن
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"ویولن"}'
                                 href="/search/category-violin/" class=" c-navi-new__medium-display-title">
                            ویولن
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: سازهای ایرانی - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"سازهای ایرانی"}'
                            href="/search/category-iranian-instruments/" class=" c-navi-new__big-display-title">
                            سازهای ایرانی
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"سازهای ایرانی"}'
                                 href="/search/category-iranian-instruments/" class=" c-navi-new__medium-display-title">
                            سازهای ایرانی
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--title"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en: Carpet - category_fa: فرش ماشینی، دستبافت، تابلو - level: 2">
                          <a data-snt-event="dkMegaMenuClick"
                             data-snt-params='{"type":"option-title","category_title":"فرش ماشینی، دستبافت، تابلو"}'
                             href="/search/category-carpet/" class=" c-navi-new__big-display-title"><span>فرش ماشینی، دستبافت، تابلو</span></a><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"فرش ماشینی، دستبافت، تابلو"}'
                            href="/search/category-carpet/" class=" c-navi-new__medium-display-title"><span>فرش ماشینی، دستبافت، تابلو</span></a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: فرش ماشینی - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"فرش ماشینی"}'
                            href="/search/category-machine-made-carpet/" class=" c-navi-new__big-display-title">
                            فرش ماشینی
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"فرش ماشینی"}'
                                 href="/search/category-machine-made-carpet/" class=" c-navi-new__medium-display-title">
                            فرش ماشینی
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: فرش دستباف - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"فرش دستباف"}'
                            href="/search/category-handmade-carpet/" class=" c-navi-new__big-display-title">
                            فرش دستباف
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"فرش دستباف"}'
                                 href="/search/category-handmade-carpet/" class=" c-navi-new__medium-display-title">
                            فرش دستباف
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: تابلو فرش - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"تابلو فرش"}'
                            href="/search/category-pictorial-carpet/" class=" c-navi-new__big-display-title">
                            تابلو فرش
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"تابلو فرش"}'
                                 href="/search/category-pictorial-carpet/" class=" c-navi-new__medium-display-title">
                            تابلو فرش
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--title"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en: Handicraft & - category_fa: صنایع دستی - level: 2"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"صنایع دستی"}'
                            href="/search/category-handicraft/"
                            class=" c-navi-new__big-display-title"><span>صنایع دستی</span></a><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"صنایع دستی"}'
                            href="/search/category-handicraft/" class=" c-navi-new__medium-display-title"><span>صنایع دستی</span></a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: کالاهای مسی - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"کالاهای مسی"}'
                            href="/search/category-copper-products/" class=" c-navi-new__big-display-title">
                            کالاهای مسی
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"کالاهای مسی"}'
                                 href="/search/category-copper-products/" class=" c-navi-new__medium-display-title">
                            کالاهای مسی
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: سفال، سرامیک و چینی - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"سفال، سرامیک و چینی"}'
                            href="/search/category-clay-and-ceramic/" class=" c-navi-new__big-display-title">
                            سفال، سرامیک و چینی
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"سفال، سرامیک و چینی"}'
                                 href="/search/category-clay-and-ceramic/" class=" c-navi-new__medium-display-title">
                            سفال، سرامیک و چینی
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: کیف چرمی - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"کیف چرمی"}'
                            href="/search/category-leatherbag/" class=" c-navi-new__big-display-title">
                            کیف چرمی
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"کیف چرمی"}'
                                 href="/search/category-leatherbag/" class=" c-navi-new__medium-display-title">
                            کیف چرمی
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: ترمه،‌ قلمکار و دستبافت - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"ترمه،‌ قلمکار و دستبافت"}'
                            href="/search/category-textile-industry/" class=" c-navi-new__big-display-title">
                            ترمه،‌ قلمکار و دستبافت
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"ترمه،‌ قلمکار و دستبافت"}'
                                 href="/search/category-textile-industry/" class=" c-navi-new__medium-display-title">
                            ترمه،‌ قلمکار و دستبافت
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: خاتم، منبت، حصیری و چوبی - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"خاتم، منبت، حصیری و چوبی"}'
                            href="/search/category-woodcraft/" class=" c-navi-new__big-display-title">
                            خاتم، منبت، حصیری و چوبی
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"خاتم، منبت، حصیری و چوبی"}'
                                 href="/search/category-woodcraft/" class=" c-navi-new__medium-display-title">
                            خاتم، منبت، حصیری و چوبی
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: تابلو و ساعت - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"تابلو و ساعت"}'
                            href="/search/category-panel/" class=" c-navi-new__big-display-title">
                            تابلو و ساعت
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"تابلو و ساعت"}'
                                 href="/search/category-panel/" class=" c-navi-new__medium-display-title">
                            تابلو و ساعت
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: میناکاری - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"میناکاری"}'
                            href="/search/category-enamels/" class=" c-navi-new__big-display-title">
                            میناکاری
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"میناکاری"}'
                                 href="/search/category-enamels/" class=" c-navi-new__medium-display-title">
                            میناکاری
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: فیروزه کوبی - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"فیروزه کوبی"}'
                            href="/search/category-turquoise-tattoo/" class=" c-navi-new__big-display-title">
                            فیروزه کوبی
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"فیروزه کوبی"}'
                                 href="/search/category-turquoise-tattoo/" class=" c-navi-new__medium-display-title">
                            فیروزه کوبی
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: سوزن دوزی - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"سوزن دوزی"}'
                            href="/search/category-traditional-sewing/" class=" c-navi-new__big-display-title">
                            سوزن دوزی
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"سوزن دوزی"}'
                                 href="/search/category-traditional-sewing/" class=" c-navi-new__medium-display-title">
                            سوزن دوزی
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: محصولات استخوانی - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"محصولات استخوانی"}'
                            href="/search/category-bone-product/" class=" c-navi-new__big-display-title">
                            محصولات استخوانی
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"محصولات استخوانی"}'
                                 href="/search/category-bone-product/" class=" c-navi-new__medium-display-title">
                            محصولات استخوانی
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: جعبه و دست سازه های هنری - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"جعبه و دست سازه های هنری"}'
                            href="/search/category-art-structures/" class=" c-navi-new__big-display-title">
                            جعبه و دست سازه های هنری
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"جعبه و دست سازه های هنری"}'
                                 href="/search/category-art-structures/" class=" c-navi-new__medium-display-title">
                            جعبه و دست سازه های هنری
                          </a>
                        </li>
                      </ul>
                    </div>
                    <div class="c-navi-new-list__options-list  js-mega-menu-category-options" id="categories-9">
                      <div class="c-navi-new-list__sublist-top-bar"><a href="/main/sport-entertainment/"
                                                                       class="c-navi-new-list__sublist-see-all-cats">
                          همه دسته‌بندی‌های ورزش و سفر
                        </a>
                      </div>
                      <ul>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--title"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: پوشاک ورزشی مردانه - level: 2"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"پوشاک ورزشی مردانه"}'
                            href="/search/category-men-sportswear/" class=" c-navi-new__big-display-title"><span>پوشاک ورزشی مردانه</span></a><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"پوشاک ورزشی مردانه"}'
                            href="/search/category-men-sportswear/" class=" c-navi-new__medium-display-title"><span>پوشاک ورزشی مردانه</span></a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--title"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: پوشاک ورزشی زنانه - level: 2"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"پوشاک ورزشی زنانه"}'
                            href="/search/category-women-sportwear/" class=" c-navi-new__big-display-title"><span>پوشاک ورزشی زنانه</span></a><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"پوشاک ورزشی زنانه"}'
                            href="/search/category-women-sportwear/" class=" c-navi-new__medium-display-title"><span>پوشاک ورزشی زنانه</span></a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--title"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: کفش ورزشی مردانه - level: 2"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"کفش ورزشی مردانه"}'
                            href="/search/category-men-sport-shoes-/" class=" c-navi-new__big-display-title"><span>کفش ورزشی مردانه</span></a><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"کفش ورزشی مردانه"}'
                            href="/search/category-men-sport-shoes-/" class=" c-navi-new__medium-display-title"><span>کفش ورزشی مردانه</span></a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--title"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: کفش ورزشی زنانه - level: 2"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"کفش ورزشی زنانه"}'
                            href="/search/category-women-sport-shoes-/" class=" c-navi-new__big-display-title"><span>کفش ورزشی زنانه</span></a><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"کفش ورزشی زنانه"}'
                            href="/search/category-women-sport-shoes-/" class=" c-navi-new__medium-display-title"><span>کفش ورزشی زنانه</span></a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--title"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: پوشاک ورزشی پسرانه - level: 2"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"پوشاک ورزشی پسرانه"}'
                            href="/search/category-boys-sportswear/" class=" c-navi-new__big-display-title"><span>پوشاک ورزشی پسرانه</span></a><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"پوشاک ورزشی پسرانه"}'
                            href="/search/category-boys-sportswear/" class=" c-navi-new__medium-display-title"><span>پوشاک ورزشی پسرانه</span></a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--title"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: پوشاک ورزشی دخترانه - level: 2"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"پوشاک ورزشی دخترانه"}'
                            href="/search/category-girls-sportswear/" class=" c-navi-new__big-display-title"><span>پوشاک ورزشی دخترانه</span></a><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"پوشاک ورزشی دخترانه"}'
                            href="/search/category-girls-sportswear/" class=" c-navi-new__medium-display-title"><span>پوشاک ورزشی دخترانه</span></a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--title"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: کفش ورزشی پسرانه - level: 2"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"کفش ورزشی پسرانه"}'
                            href="/search/category-boys-sport-shoes/" class=" c-navi-new__big-display-title"><span>کفش ورزشی پسرانه</span></a><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"کفش ورزشی پسرانه"}'
                            href="/search/category-boys-sport-shoes/" class=" c-navi-new__medium-display-title"><span>کفش ورزشی پسرانه</span></a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--title"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: کفش ورزشی دخترانه - level: 2"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"کفش ورزشی دخترانه"}'
                            href="/search/category-girls-sport-shoes/" class=" c-navi-new__big-display-title"><span>کفش ورزشی دخترانه</span></a><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"کفش ورزشی دخترانه"}'
                            href="/search/category-girls-sport-shoes/" class=" c-navi-new__medium-display-title"><span>کفش ورزشی دخترانه</span></a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--title"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: تجهیزات سفر - level: 2"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"تجهیزات سفر"}'
                            href="/search/category-traveling-equipment/" class=" c-navi-new__big-display-title"><span>تجهیزات سفر</span></a><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"تجهیزات سفر"}'
                            href="/search/category-traveling-equipment/"
                            class=" c-navi-new__medium-display-title"><span>تجهیزات سفر</span></a></li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: چمدان و ساک - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"چمدان و ساک"}'
                            href="/search/category-trolley-case-and-luggage/" class=" c-navi-new__big-display-title">
                            چمدان و ساک
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"چمدان و ساک"}'
                                 href="/search/category-trolley-case-and-luggage/"
                                 class=" c-navi-new__medium-display-title">
                            چمدان و ساک
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: کیف و کوله پشتی - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"کیف و کوله پشتی"}'
                            href="/search/category-bag-and-backpack/" class=" c-navi-new__big-display-title">
                            کیف و کوله پشتی
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"کیف و کوله پشتی"}'
                                 href="/search/category-bag-and-backpack/" class=" c-navi-new__medium-display-title">
                            کیف و کوله پشتی
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--title"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: دوچرخه - level: 2"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"دوچرخه"}'
                            href="/search/category-bicycle/" class=" c-navi-new__big-display-title"><span>دوچرخه</span></a><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"دوچرخه"}'
                            href="/search/category-bicycle/"
                            class=" c-navi-new__medium-display-title"><span>دوچرخه</span></a></li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: لوازم جانبی دوچرخه - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"لوازم جانبی دوچرخه"}'
                            href="/search/category-bicycles-accessories/" class=" c-navi-new__big-display-title">
                            لوازم جانبی دوچرخه
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"لوازم جانبی دوچرخه"}'
                                 href="/search/category-bicycles-accessories/"
                                 class=" c-navi-new__medium-display-title">
                            لوازم جانبی دوچرخه
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--title"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: کوهنوردی و کمپینگ - level: 2"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"کوهنوردی و کمپینگ"}'
                            href="/search/category-hiking-and-camping/" class=" c-navi-new__big-display-title"><span>کوهنوردی و کمپینگ</span></a><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"کوهنوردی و کمپینگ"}'
                            href="/search/category-hiking-and-camping/" class=" c-navi-new__medium-display-title"><span>کوهنوردی و کمپینگ</span></a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: کفش کوهنوردی - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"کفش کوهنوردی"}'
                            href="/search/category-apparel/?q=%da%a9%d9%81%d8%b4%20%da%a9%d9%88%d9%87%d9%86%d9%88%d8%b1%d8%af%db%8c&entry=mm"
                            class=" c-navi-new__big-display-title">
                            کفش کوهنوردی
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"کفش کوهنوردی"}'
                                 href="/search/category-apparel/?q=%da%a9%d9%81%d8%b4%20%da%a9%d9%88%d9%87%d9%86%d9%88%d8%b1%d8%af%db%8c&entry=mm"
                                 class=" c-navi-new__medium-display-title">
                            کفش کوهنوردی
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: عصای کوهنوردی - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"عصای کوهنوردی"}'
                            href="/search/category-staff/" class=" c-navi-new__big-display-title">
                            عصای کوهنوردی
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"عصای کوهنوردی"}'
                                 href="/search/category-staff/" class=" c-navi-new__medium-display-title">
                            عصای کوهنوردی
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: چراغ قوه و چراغ پیشانی - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"چراغ قوه و چراغ پیشانی"}'
                            href="/search/category-flashlight/" class=" c-navi-new__big-display-title">
                            چراغ قوه و چراغ پیشانی
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"چراغ قوه و چراغ پیشانی"}'
                                 href="/search/category-flashlight/" class=" c-navi-new__medium-display-title">
                            چراغ قوه و چراغ پیشانی
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: چاقو و ابزار چند کاره - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"چاقو و ابزار چند کاره"}'
                            href="/search/category-camping-knife/" class=" c-navi-new__big-display-title">
                            چاقو و ابزار چند کاره
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"چاقو و ابزار چند کاره"}'
                                 href="/search/category-camping-knife/" class=" c-navi-new__medium-display-title">
                            چاقو و ابزار چند کاره
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: قمقمه و فلاسک - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"قمقمه و فلاسک"}'
                            href="/search/category-flask/" class=" c-navi-new__big-display-title">
                            قمقمه و فلاسک
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"قمقمه و فلاسک"}'
                                 href="/search/category-flask/" class=" c-navi-new__medium-display-title">
                            قمقمه و فلاسک
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: چادر - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"چادر"}'
                            href="/search/category-tent/" class=" c-navi-new__big-display-title">
                            چادر
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"چادر"}'
                                 href="/search/category-tent/" class=" c-navi-new__medium-display-title">
                            چادر
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: کیسه خواب - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"کیسه خواب"}'
                            href="/search/category-sleeping-bag/" class=" c-navi-new__big-display-title">
                            کیسه خواب
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"کیسه خواب"}'
                                 href="/search/category-sleeping-bag/" class=" c-navi-new__medium-display-title">
                            کیسه خواب
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: زیرانداز سفری - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"زیرانداز سفری"}'
                            href="/search/category-mat/" class=" c-navi-new__big-display-title">
                            زیرانداز سفری
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"زیرانداز سفری"}'
                                 href="/search/category-mat/" class=" c-navi-new__medium-display-title">
                            زیرانداز سفری
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--title"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: لوازم جانبی کوهنوردی و سفر - level: 2"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"لوازم جانبی کوهنوردی و سفر"}'
                            href="/search/category-travel-accessories/" class=" c-navi-new__big-display-title"><span>لوازم جانبی کوهنوردی و سفر</span></a><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"لوازم جانبی کوهنوردی و سفر"}'
                            href="/search/category-travel-accessories/" class=" c-navi-new__medium-display-title"><span>لوازم جانبی کوهنوردی و سفر</span></a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--title"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: چتر - level: 2"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"چتر"}'
                            href="/search/category-umbrella-1/" class=" c-navi-new__big-display-title"><span>چتر</span></a><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"چتر"}'
                            href="/search/category-umbrella-1/"
                            class=" c-navi-new__medium-display-title"><span>چتر</span></a></li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--title"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: ساک ورزشی - level: 2"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"ساک ورزشی"}'
                            href="/search/category-trolley-case-and-luggage/?q=%d8%b3%d8%a7%da%a9%20%d9%88%d8%b1%d8%b2%d8%b4%db%8c&entry=mm"
                            class=" c-navi-new__big-display-title"><span>ساک ورزشی</span></a><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"ساک ورزشی"}'
                            href="/search/category-trolley-case-and-luggage/?q=%d8%b3%d8%a7%da%a9%20%d9%88%d8%b1%d8%b2%d8%b4%db%8c&entry=mm"
                            class=" c-navi-new__medium-display-title"><span>ساک ورزشی</span></a></li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--title"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: قمقمه و شیکر - level: 2"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"قمقمه و شیکر"}'
                            href="/search/category-sport-entertainment/?q=%d8%b4%db%8c%da%a9%d8%b1&entry=mm"
                            class=" c-navi-new__big-display-title"><span>قمقمه و شیکر</span></a><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"قمقمه و شیکر"}'
                            href="/search/category-sport-entertainment/?q=%d8%b4%db%8c%da%a9%d8%b1&entry=mm"
                            class=" c-navi-new__medium-display-title"><span>قمقمه و شیکر</span></a></li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--title"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: لوازم ورزشی - level: 2"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"لوازم ورزشی"}'
                            href="/search/category-sport/"
                            class=" c-navi-new__big-display-title"><span>لوازم ورزشی</span></a><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"لوازم ورزشی"}'
                            href="/search/category-sport/"
                            class=" c-navi-new__medium-display-title"><span>لوازم ورزشی</span></a></li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--title"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: ورزش های هوازی و بدنسازی - level: 2"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"ورزش های هوازی و بدنسازی"}'
                            href="/search/category-aerobic/" class=" c-navi-new__big-display-title"><span>ورزش های هوازی و بدنسازی</span></a><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"ورزش های هوازی و بدنسازی"}'
                            href="/search/category-aerobic/" class=" c-navi-new__medium-display-title"><span>ورزش های هوازی و بدنسازی</span></a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: تجهیزات جانبی ایروبیک و تناسب اندام - level: 3">
                          <a data-snt-event="dkMegaMenuClick"
                             data-snt-params='{"type":"option-item","category_title":"تجهیزات جانبی ایروبیک و تناسب اندام"}'
                             href="/search/category-stretching-tools/" class=" c-navi-new__big-display-title">
                            تجهیزات جانبی ایروبیک و تناسب اندام
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"تجهیزات جانبی ایروبیک و تناسب اندام"}'
                                 href="/search/category-stretching-tools/" class=" c-navi-new__medium-display-title">
                            تجهیزات جانبی ایروبیک و تناسب اندام
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: دمبل - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"دمبل"}'
                            href="/search/category-dumbbell/" class=" c-navi-new__big-display-title">
                            دمبل
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"دمبل"}'
                                 href="/search/category-dumbbell/" class=" c-navi-new__medium-display-title">
                            دمبل
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: طناب - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"طناب"}'
                            href="/search/category-rope/" class=" c-navi-new__big-display-title">
                            طناب
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"طناب"}'
                                 href="/search/category-rope/" class=" c-navi-new__medium-display-title">
                            طناب
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: بارفیکس - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"بارفیکس"}'
                            href="/search/category-pullup/" class=" c-navi-new__big-display-title">
                            بارفیکس
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"بارفیکس"}'
                                 href="/search/category-pullup/" class=" c-navi-new__medium-display-title">
                            بارفیکس
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: تردمیل - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"تردمیل"}'
                            href="/search/category-treadmill/" class=" c-navi-new__big-display-title">
                            تردمیل
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"تردمیل"}'
                                 href="/search/category-treadmill/" class=" c-navi-new__medium-display-title">
                            تردمیل
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: لوازم پوششی و محافظتی ورزشی - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"لوازم پوششی و محافظتی ورزشی"}'
                            href="/search/category-cover-and-safety-equipment/" class=" c-navi-new__big-display-title">
                            لوازم پوششی و محافظتی ورزشی
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"لوازم پوششی و محافظتی ورزشی"}'
                                 href="/search/category-cover-and-safety-equipment/"
                                 class=" c-navi-new__medium-display-title">
                            لوازم پوششی و محافظتی ورزشی
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--title"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: ورزش های توپی - level: 2"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"ورزش های توپی"}'
                            href="/search/category-ball-sports/" class=" c-navi-new__big-display-title"><span>ورزش های توپی</span></a><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"ورزش های توپی"}'
                            href="/search/category-ball-sports/" class=" c-navi-new__medium-display-title"><span>ورزش های توپی</span></a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: توپ - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"توپ"}'
                            href="/search/category-ball/" class=" c-navi-new__big-display-title">
                            توپ
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"توپ"}'
                                 href="/search/category-ball/" class=" c-navi-new__medium-display-title">
                            توپ
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: راکت - level: 3"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-item","category_title":"راکت"}'
                            href="/search/category-racquet/" class=" c-navi-new__big-display-title">
                            راکت
                          </a><a data-snt-event="dkMegaMenuClick"
                                 data-snt-params='{"type":"option-item","category_title":"راکت"}'
                                 href="/search/category-racquet/" class=" c-navi-new__medium-display-title">
                            راکت
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--title"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: ورزش‌های آبی - level: 2"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"ورزش‌های آبی"}'
                            href="/search/category-water-games/" class=" c-navi-new__big-display-title"><span>ورزش‌های آبی</span></a><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"ورزش‌های آبی"}'
                            href="/search/category-water-games/" class=" c-navi-new__medium-display-title"><span>ورزش‌های آبی</span></a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--title"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: ورزش‌های رزمی - level: 2"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"ورزش‌های رزمی"}'
                            href="/search/category-martial-arts/" class=" c-navi-new__big-display-title"><span>ورزش‌های رزمی</span></a><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"ورزش‌های رزمی"}'
                            href="/search/category-martial-arts/" class=" c-navi-new__medium-display-title"><span>ورزش‌های رزمی</span></a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--title"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: اسکوتر برقی - level: 2"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"اسکوتر برقی"}'
                            href="/search/category-sports-hoverboard/" class=" c-navi-new__big-display-title"><span>اسکوتر برقی</span></a><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"اسکوتر برقی"}'
                            href="/search/category-sports-hoverboard/" class=" c-navi-new__medium-display-title"><span>اسکوتر برقی</span></a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--title"
                            data-event="megamenu_click" data-event-category="header_section"
                            data-event-label="category_en:  - category_fa: اسکیت و اسکوتر - level: 2"><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"اسکیت و اسکوتر"}'
                            href="/search/category-skate/"
                            class=" c-navi-new__big-display-title"><span>اسکیت و اسکوتر</span></a><a
                            data-snt-event="dkMegaMenuClick"
                            data-snt-params='{"type":"option-title","category_title":"اسکیت و اسکوتر"}'
                            href="/search/category-skate/" class=" c-navi-new__medium-display-title"><span>اسکیت و اسکوتر</span></a>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
              </li>
              <li class="js-categories-bar-item">
                <a href="/main/food-beverage/"
                   class="c-navi-new-list__category-link c-navi-new-list__category-link--fresh c-navi-new-list__category-link--bold">سوپرمارکت</a>
              </li>
              <li class="js-categories-bar-item js-mega-menu-main-item js-promotion-mega-menu">
                <a href="/promotion-center/"
                   class="c-navi-new-list__category-link c-navi-new-list__category-link--amazing c-navi-new-list__category-link--bold">تخفیف‌ها
                  و پیشنهادها</a>
                <div
                  class="c-navi-new-list__sublist c-navi-new-list__sublist--promotion js-mega-menu-categories-options">
                  <div class="c-navi-new-list__options-container">
                    <div class="c-navi-new-list__options-list is-active">
                      <div class="c-navi-new-list__sublist-top-bar"><a href="/promotion-center/"
                                                                       class="c-navi-new-list__sublist-see-all-cats">
                          مشاهده همه تخفیف‌ها و پیشنهادها
                        </a>
                      </div>
                      <ul>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--title"><a
                            href="/incredible-offers/"
                            class=" c-navi-new__big-display-title"><span>کالاهای شگفت‌انگیز</span></a><a
                            href="/incredible-offers/" class=" c-navi-new__medium-display-title"><span>کالاهای شگفت‌انگیز</span></a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--title"><a
                            href="/fresh-offers/"
                            class=" c-navi-new__big-display-title"><span>شگفت‌انگیز سوپرمارکتی</span></a><a
                            href="/fresh-offers/"
                            class=" c-navi-new__medium-display-title"><span>شگفت‌انگیز سوپرمارکتی</span></a></li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--title"><a
                            href="/landing-page/?promotion_types%5B0%5D=incredible_offer&promotion_types%5B1%5D=promotion&promotion_times%5B0%5D=active"
                            class=" c-navi-new__big-display-title"><span>فروش ویژه</span></a><a
                            href="/landing-page/?promotion_types%5B0%5D=incredible_offer&promotion_types%5B1%5D=promotion&promotion_times%5B0%5D=active"
                            class=" c-navi-new__medium-display-title"><span>فروش ویژه</span></a></li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"><a
                            href="/landing-page/?category%5B0%5D=5966&promotion_types%5B0%5D=incredible_offer&promotion_types%5B1%5D=promotion&promotion_times%5B0%5D=active"
                            class=" c-navi-new__big-display-title">
                            کالای دیجیتال
                          </a><a
                            href="/landing-page/?category%5B0%5D=5966&promotion_types%5B0%5D=incredible_offer&promotion_types%5B1%5D=promotion&promotion_times%5B0%5D=active"
                            class=" c-navi-new__medium-display-title">
                            کالای دیجیتال
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"><a
                            href="/landing-page/?category%5B0%5D=8450&promotion_types%5B0%5D=incredible_offer&promotion_types%5B1%5D=promotion&promotion_times%5B0%5D=active"
                            class=" c-navi-new__big-display-title">
                            خودرو، ابزار و تجهیزات صنعتی
                          </a><a
                            href="/landing-page/?category%5B0%5D=8450&promotion_types%5B0%5D=incredible_offer&promotion_types%5B1%5D=promotion&promotion_times%5B0%5D=active"
                            class=" c-navi-new__medium-display-title">
                            خودرو، ابزار و تجهیزات صنعتی
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"><a
                            href="/landing-page/?category%5B0%5D=8749&promotion_types%5B0%5D=incredible_offer&promotion_types%5B1%5D=promotion&promotion_times%5B0%5D=active"
                            class=" c-navi-new__big-display-title">
                            مد و پوشاک
                          </a><a
                            href="/landing-page/?category%5B0%5D=8749&promotion_types%5B0%5D=incredible_offer&promotion_types%5B1%5D=promotion&promotion_times%5B0%5D=active"
                            class=" c-navi-new__medium-display-title">
                            مد و پوشاک
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"><a
                            href="/landing-page/?category%5B0%5D=6741&promotion_types%5B0%5D=incredible_offer&promotion_types%5B1%5D=promotion&promotion_times%5B0%5D=active"
                            class=" c-navi-new__big-display-title">
                            اسباب بازی، کودک و نوزاد
                          </a><a
                            href="/landing-page/?category%5B0%5D=6741&promotion_types%5B0%5D=incredible_offer&promotion_types%5B1%5D=promotion&promotion_times%5B0%5D=active"
                            class=" c-navi-new__medium-display-title">
                            اسباب بازی، کودک و نوزاد
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"><a
                            href="/landing-page/?category%5B0%5D=8895&promotion_types%5B0%5D=incredible_offer&promotion_types%5B1%5D=promotion&promotion_times%5B0%5D=active"
                            class=" c-navi-new__big-display-title">
                            کالاهای سوپرمارکتی
                          </a><a
                            href="/landing-page/?category%5B0%5D=8895&promotion_types%5B0%5D=incredible_offer&promotion_types%5B1%5D=promotion&promotion_times%5B0%5D=active"
                            class=" c-navi-new__medium-display-title">
                            کالاهای سوپرمارکتی
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"><a
                            href="/landing-page/?category%5B0%5D=5968&promotion_types%5B0%5D=incredible_offer&promotion_types%5B1%5D=promotion&promotion_times%5B0%5D=active"
                            class=" c-navi-new__big-display-title">
                            زیبایی و سلامت
                          </a><a
                            href="/landing-page/?category%5B0%5D=5968&promotion_types%5B0%5D=incredible_offer&promotion_types%5B1%5D=promotion&promotion_times%5B0%5D=active"
                            class=" c-navi-new__medium-display-title">
                            زیبایی و سلامت
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"><a
                            href="/landing-page/?category%5B0%5D=5967&promotion_types%5B0%5D=incredible_offer&promotion_types%5B1%5D=promotion&promotion_times%5B0%5D=active"
                            class=" c-navi-new__big-display-title">
                            خانه و آشپزخانه
                          </a><a
                            href="/landing-page/?category%5B0%5D=5967&promotion_types%5B0%5D=incredible_offer&promotion_types%5B1%5D=promotion&promotion_times%5B0%5D=active"
                            class=" c-navi-new__medium-display-title">
                            خانه و آشپزخانه
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"><a
                            href="/landing-page/?category%5B0%5D=8&promotion_types%5B0%5D=incredible_offer&promotion_types%5B1%5D=promotion&promotion_times%5B0%5D=active"
                            class=" c-navi-new__big-display-title">
                            کتاب، لوازم تحریر و هنر
                          </a><a
                            href="/landing-page/?category%5B0%5D=8&promotion_types%5B0%5D=incredible_offer&promotion_types%5B1%5D=promotion&promotion_times%5B0%5D=active"
                            class=" c-navi-new__medium-display-title">
                            کتاب، لوازم تحریر و هنر
                          </a>
                        </li>
                        <li class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item"><a
                            href="/landing-page/?category%5B0%5D=6124&promotion_types%5B0%5D=incredible_offer&promotion_types%5B1%5D=promotion&promotion_times%5B0%5D=active"
                            class=" c-navi-new__big-display-title">
                            ورزش و سفر
                          </a><a
                            href="/landing-page/?category%5B0%5D=6124&promotion_types%5B0%5D=incredible_offer&promotion_types%5B1%5D=promotion&promotion_times%5B0%5D=active"
                            class=" c-navi-new__medium-display-title">
                            ورزش و سفر
                          </a>
                        </li>
                        <li
                          class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item c-navi-new-list__sublist-option--has-circle">
                          <a href="/promotion-center/category-based-products/29/"
                             class=" c-navi-new__big-display-title">
                            تلفن کمتر از ۲۹۹ هزار تومان
                          </a><a href="/promotion-center/category-based-products/29/"
                                 class=" c-navi-new__medium-display-title">
                            تلفن کمتر از ۲۹۹ هزار تومان
                          </a>
                        </li>
                        <li
                          class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--item c-navi-new-list__sublist-option--has-circle">
                          <a href="/promotion-center/category-based-products/24/"
                             class=" c-navi-new__big-display-title">
                            کتاب چاپی تا ۷۰ درصد تخقیف
                          </a><a href="/promotion-center/category-based-products/24/"
                                 class=" c-navi-new__medium-display-title">
                            کتاب چاپی تا ۷۰ درصد تخقیف
                          </a>
                        </li>
                        <div class="c-navi-new-list__sublist-divider"></div>
                        <li
                          class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--has-icon c-navi-new-list__sublist-option--new-customer u-hidden">
                          <a href="/landings/new-customer/" class=" c-navi-new__big-display-title">
                            مشتریان جدید
                          </a><a href="/landings/new-customer/" class=" c-navi-new__medium-display-title">
                            مشتریان جدید
                          </a>
                        </li>
                        <li
                          class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--has-icon c-navi-new-list__sublist-option--best-selling">
                          <a href="/best-selling/" class=" c-navi-new__big-display-title">
                            پرفروش‌ترین‌ کالاها
                          </a><a href="/best-selling/" class=" c-navi-new__medium-display-title">
                            پرفروش‌ترین‌ کالاها
                          </a>
                        </li>
                        <li
                          class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--has-icon c-navi-new-list__sublist-option--gift">
                          <a href="/promotion-center/products-with-gifts/" class=" c-navi-new__big-display-title">
                            با هر خرید هدیه بگیرید!
                          </a><a href="/promotion-center/products-with-gifts/"
                                 class=" c-navi-new__medium-display-title">
                            با هر خرید هدیه بگیرید!
                          </a>
                        </li>
                        <li
                          class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--has-icon c-navi-new-list__sublist-option--last-season">
                          <a href="/promotion-page/cmp_109599/" class=" c-navi-new__big-display-title">
                            تخفیف پایان فصل
                          </a><a href="/promotion-page/cmp_109599/" class=" c-navi-new__medium-display-title">
                            تخفیف پایان فصل
                          </a>
                        </li>
                        <li
                          class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--has-icon c-navi-new-list__sublist-option--gift-card">
                          <a href="/search/category-dk-ds-gift-card/" class=" c-navi-new__big-display-title">
                            کارت هدیه خرید از {{ $fa_store_name }}
                          </a><a href="/search/category-dk-ds-gift-card/" class=" c-navi-new__medium-display-title">
                            کارت هدیه خرید از {{ $fa_store_name }}
                          </a>
                        </li>
                        <li
                          class="c-navi-new-list__sublist-option c-navi-new-list__sublist-option--has-icon c-navi-new-list__sublist-option--new-seller-product">
                          <a href="/promotion-center/new-sellers-products/" class=" c-navi-new__big-display-title">
                            تازه‌های فروشنده‌های جدید
                          </a><a href="/promotion-center/new-sellers-products/"
                                 class=" c-navi-new__medium-display-title">
                            تازه‌های فروشنده‌های جدید
                          </a>
                        </li>
                      </ul>
                    </div>
                  </div>
                  <div class="c-navi-new-list__main-banner"><a data-observed="0" class="js-promotion-mega-menu-banner"
                                                               href="https://www.digikala.com/promotion-center/?&promo_name=%D8%AA%D8%AE%D9%81%DB%8C%D9%81+%D9%87%D8%A7+%D9%88+%D9%BE%DB%8C%D8%B4%D9%86%D9%87%D8%A7%D8%AF%D9%87%D8%A7&promo_position=promotion_center_mega_menu&promo_creative=58152&bCode=58152"
                                                               data-id="58152"><img
                        src="https://dkstatics-public.digikala.com/digikala-adservice-banners/560de61ce10e86ee53603192ed6e3320fd0d0923_1610191059.png?x-oss-process=image/quality,q_80"/></a>
                  </div>
                </div>
              </li>
              <li class="js-categories-bar-item">
                <a
                  class="c-navi-new-list__category-link c-navi-new-list__category-link--my-digikala c-navi-new-list__category-link--bold"
                  href="/my-digikala/">
                  {{ $fa_store_name }}ی من
                </a>
              </li>
              <li class="js-categories-bar-item js-mega-menu-main-item">
                <a
                  class="c-navi-new-list__category-link c-navi-new-list__category-link--bold c-navi-new-list__category-link--plus c-digiplus-sign--before"
                  href="/plus/landing/">
                  دیجی‌پلاس
                </a>
                <div
                  class="c-navi-new-list__sublist c-navi-new-list__sublist--digiplus js-mega-menu-categories-options">
                  <div class="c-dp-header-submenu">
                    <div class="c-dp-header-submenu__content">
                      <div class="c-dp-header-submenu__head-title">
                        خدمات ویژه کاربران <img src="https://www.digikala.com/static/files/4a2895fc.svg" alt="Digiplus">
                      </div>
                      <div class="c-dp-header-submenu__head-subtitle">
                        ارسال رایگان بدون محدودیت قیمت، هدیه نقدی و بازگشت کالا تا ۳۰ روز پس از تحویل
                      </div>
                      <ul class="c-dp-header-submenu__nav">
                        <li class="c-dp-header-submenu__nav-item c-dp-header-submenu__nav-item--register">
                          <a class="c-dp-header-submenu__register o-btn o-btn--link-blue-md"
                             href="/plus/landing/">
                            اطلاعات بیشتر و عضویت
                          </a>
                        </li>
                        <li class="c-dp-header-submenu__nav-item c-dp-header-submenu__nav-item--plus-products">
                          <a class="c-dp-header-submenu__nav-link"
                             href="/search/?only_plus=1&digiplus%5B0%5D=has_plus_cash_back">
                            کالاهای <img src="https://www.digikala.com/static/files/4a2895fc.svg" alt="Digiplus">
                          </a>
                        </li>
                      </ul>
                    </div>
                    <a class="c-dp-header-submenu__banner-link"
                       href="/plus/landing/">
                      <img class="c-dp-header-submenu__banner-img"
                           src="https://www.digikala.com/static/files/38492329.jpg"
                           alt="Banner"
                      >
                    </a>
                  </div>
                </div>
              </li>
              <li class="js-categories-bar-item js-mega-menu-main-item">
                <a href="/digiclub/"
                   class="c-navi-new-list__category-link c-navi-new-list__category-link--digiclub c-navi-new-list__category-link--bold">دیجی‌کلاب</a>
                <div
                  class="c-navi-new-list__sublist c-navi-new-list__sublist--digiclub js-mega-menu-categories-options">
                  <div class="c-dc-header-submenu">
                    <div class="c-dc-header-submenu__content">
                      <div class="c-dc-points c-dc-points--gold">
                        امتیاز شما:
                        <span class="c-dc-points__number js-dc-point">۰</span>
                        <img class="c-dc-points__coin"
                             src="https://www.digikala.com/static/files/5ca024e6.svg"
                             alt="Digiclub Points"
                        >
                      </div>
                      <ul class="c-dc-header-submenu__nav">
                        <li class="c-dc-header-submenu__nav-item">
                          <a class="c-dc-header-submenu__nav-link c-dc-header-submenu__nav-link--main"
                             href="/digiclub/"
                          >
                            صفحه اصلی دیجی‌کلاب
                          </a>
                        </li>
                        <li class="c-dc-header-submenu__nav-item">
                          <a class="c-dc-header-submenu__nav-link c-dc-header-submenu__nav-link--rewards"
                             href="/digiclub/rewards/"
                          >
                            جوایز دیجی‌کلاب
                          </a>
                        </li>
                        <li class="c-dc-header-submenu__nav-item">
                          <a class="c-dc-header-submenu__nav-link c-dc-header-submenu__nav-link--history"
                             href="/digiclub/history/"
                          >
                            تاریخچه امتیازات دیجی‌کلاب
                          </a>
                        </li>
                        <li class="c-dc-header-submenu__nav-item">
                          <a class="c-dc-header-submenu__nav-link c-dc-header-submenu__nav-link--missions"
                             href="/digiclub/missions/"
                          >
                            ماموریت‌های دیجی‌کلابی
                          </a>
                        </li>
                        <li class="c-dc-header-submenu__nav-item">
                          <a class="c-dc-header-submenu__nav-link c-dc-header-submenu__nav-link--luckydraw"
                             href="/digiclub/luckydraw/"
                          >
                            قرعه‌کشی
                            <div class="c-dc-lucky-counter c-dc-lucky-counter--header js-dc-counter u-hidden">
                              <div
                                class="c-dc-lucky-counter__time c-dc-lucky-counter__time--header c-dc-lucky-counter__time--first-child js-dc-counter-days"></div>
                              <div
                                class="c-dc-lucky-counter__time c-dc-lucky-counter__time--header js-dc-counter-hours"></div>
                              <div
                                class="c-dc-lucky-counter__time c-dc-lucky-counter__time--header js-dc-counter-minutes"></div>
                              <div
                                class="c-dc-lucky-counter__time c-dc-lucky-counter__time--header js-dc-counter-seconds"></div>
                            </div>
                          </a>
                        </li>
                      </ul>
                    </div>
                    <a class="c-dc-header-submenu__banner-link"
                       href="https://dgka.la/dcdkhomepaege"
                    >
                      <img class="c-dc-header-submenu__banner-img"
                           src="https://dkstatics-public.digikala.com/digiclub/53aa31f81138fd588df842086e152102979a00d7_1601458094.jpg"
                           alt=""
                      >
                    </a>
                  </div>
                </div>
              </li>
              <li class="js-categories-bar-item">
                <a href="/my-digipay/"
                   class="c-navi-new-list__category-link c-navi-new-list__category-link--digipay c-navi-new-list__category-link--bold">
                  دیجی‌پی
                </a>
              </li>
              <li class="js-categories-bar-item c-navi-new-list__category-link--visible-in-wide">
                <a class="c-navi-new-list__category-link" target="_blank" href="/faq/">
                  سوالی دارید؟
                </a>
              </li>
              <li class="js-categories-bar-item"><a
                  class="c-navi-new-list__category-link c-navi-new-list__category-link--visible-in-wide"
                  target="_blank"
                  href="https://www.digikala.com/landings/seller-introduction/?headerEntry=1">
                  فروشنده شوید
                </a>
              </li>
            </ul>
          </li>
          <li class="c-navi-new-list__categories">
            <ul class="c-navi-new-list__category-item">
              <li
                class="c-navi-new-list__category c-navi-new-list__category--location has-notification js-general-location-bar">
                <span class="c-navi-new-list__category-location">لطفا شهر و استان خود را انتخاب کنید</span>
              </li>
            </ul>
          </li>
          <script>
            var insider_object = {
              "user": {
                "uuid": "",
                "name": "",
                "surename": "",
                "email": "",
                "phone_number": "",
                "gdpr_optin": true,
                "email_optin": true
              }
            };
          </script>
          <input type="hidden" id="ESILogged" data-logged=0/>
        </ul>
      </div>
    </div>
  </nav>
</header>
<div class="c-navi-categories__overlay js-navi-overlay"></div>
<main id="main">
  <div id="HomePageTopBanner"></div>
  <div id="content">
    <div class="container c-shipment-page">
      <ul class="c-checkout-steps">
        <li class="is-active is-completed">
          <a class="c-checkout-steps__item-link">
            <div class="c-checkout-steps__item c-checkout-steps__item--summary" data-title="اطلاعات ارسال"></div>
          </a>
        </li>
        <li class=" ">
          <a class="c-checkout-steps__item-link js-shipping-timeline">
            <div class="c-checkout-steps__item c-checkout-steps__item--delivery" data-title="پرداخت"></div>
          </a>
        </li>
        <li class="">
          <div class="c-checkout-steps__item c-checkout-steps__item--payment" data-title="اتمام خرید و ارسال"></div>
        </li>
      </ul>
      <section class="o-page">
        <div class="o-page__row">
          <section class="o-page__content">
            <p class="c-message-light-small c-message-light-small--info c-shipment-page__shared-address-message js-is-shared-address-message u-hidden">
              آدرس انتخاب شده تحویل سفارش یک آدرس عمومی است و کالاها به آدرس شخصی شما ارسال نمی‌شوند. پیش از نهایی کردن
              خرید از صحیح بودن آدرس اطمینان حاصل نمایید.
            </p>
            <div class="c-shipment-page__container" id="shipping-data">
              <div id="address-section">
                <div class="c-checkout-contact is-completed js-user-address-container" id="user-default-address-container" data-address='{"id":{{ $customer->delivery_address->id }},"full_name":"{{ $customer->first_name . ' ' . $customer->last_name }}","mobile_phone":"{{ 0 . $customer->mobile }}","phone_code":null,"post_code":"1212121212","phone":null,"address":"{{ $customer->delivery_address->address }}","description":null,"active":true,"default":true,"city_id":xxxxxx,"city_name":"xxxxx","state_id":0,"state_name":"xxxxx","district_id":0,"district_name":"xxxxx","building_no":"1","unit":null,"full_address":"xxxxxx","map_lon":{{ $customer->delivery_address->len }},"map_lat":{{ $customer->delivery_address->lan }},"map_lon_mobile":"{{ $customer->delivery_address->len }}","map_lat_mobile":"{{ $customer->delivery_address->lan }}","map_lon_web":"{{ $customer->delivery_address->len }}","map_lat_web":"{{ $customer->delivery_address->lan }}","fmcg_support":true,"is_shared_address":false,"shared_address_id":null}'>
                  <div class="c-checkout-contact__content js-default-recipient-box">
                    <div class="c-checkout-contact__title">
                      آدرس تحویل سفارش
                    </div>
                    <input type="hidden" id="address-id" name="addressId" value="">
                    <ul class="c-checkout-contact__items">
                      <li class="c-checkout-contact__item c-checkout-contact__item--address js-recipient-address-part">
                        {{ persianNum($customer->delivery_address->address) }}
                      </li>
                      <li class="c-checkout-contact__item c-checkout-contact__item--username">
                        {{ $customer->first_name . ' ' . $customer->last_name }}
                      </li>
                      <li class="c-checkout-contact__item">
                        <button type="button" class="o-link o-link--sm o-link--has-arrow" id="change-address-btn">
                          تغییر آدرس
                        </button>
                      </li>
                    </ul>
                  </div>
                </div>
                <div class="c-checkout-address js-user-address-container" id="user-address-list-container" style="display: none">
                  <div class="c-checkout-address__headline">
                    <div class="c-checkout-address__title">آدرس تحویل سفارش را انتخاب نمایید:</div>
                    <div class="o-btn c-checkout-address__close" id="cancel-change-address-btn"></div>
                  </div>
                  <div class="o-box__tabs">
                    <div class="o-box__tab js-ui-tab-pill is-active" data-tab-pill-id="userAddresses">
                      آدرس‌های شما
                    </div>
                    @if (count($store_addresses))
                      <div class="o-box__tab js-ui-tab-pill" data-tab-pill-id="dropOff">
                        آدرس‌های مراکز دریافت {{ $fa_store_name }}
                      </div>
                    @endif
                  </div>
                  <div class="c-checkout-address__content js-ui-tab-content" data-tab-content-id="userAddresses">
                    <div class="c-checkout-address__content">
                      @foreach($customer->addresses as $address)
                        @if ($customer->where('address_type', 'CustomerAddress')->exists())
                          <?php $is_selected_id = $customer->delivery_address->id; ?>
                        @else
                          <?php $is_selected_id = null; ?>
                        @endif
                        <div class="c-checkout-address__item js-recipient-box js-user-address-container js-address-box {{ ($is_selected_id == $address->id)? 'is-selected' : '' }}" data-id="{{ $address->id }}" data-event="change_address" data-event-category="funnel" data-event-label="addresses: 2" data-address='{"id":{{ $address->id }},"full_name":"{{ $customer->first_name . ' ' . $customer->last_name }}","mobile_phone":"{{ 0 . $customer->mobile }}","phone_code":null,"post_code":"1212121212","phone":null,"address":"{{ $address->address }}","description":null,"active":true,"default":true,"city_id":0,"city_name":"xxxxxxxxxx","state_id":0,"state_name":"xxxxxxxxxx","district_id":0,"district_name":"xxxxxxxxxx","building_no":"1","unit":null,"full_address":"{{ $address->address }}","map_lon":{{ $address->len }},"map_lat":{{ $address->lan }},"map_lon_mobile":"{{ $address->len }}","map_lat_mobile":"{{ $address->lan }}","map_lon_web":"{{ $address->len }}","map_lat_web":"{{ $address->lan }}","fmcg_support":true,"is_shared_address":false,"shared_address_id":null}'>
                          <div class="c-checkout-address__item-headline">
                            <label class="c-outline-radio">
                              <input type="radio" name="address" {{ ($is_selected_id == $address->id)? 'checked' : '' }}>
                              <span class="c-outline-radio__check"></span>
                            </label>

                            {{ ($is_selected_id == $address->id)? 'به این آدرس ارسال می‌شود' : 'ارسال به این آدرس' }}
                          </div>
                          <ul class="c-checkout-address__item-content">
                            <li class="c-checkout-address__item-address">
                              {{ $address->address }}
                            </li>
                            @if(!is_null($address->postal_code))
                              <li class="c-checkout-address__item-detail c-checkout-address__item-detail--postal-code">
                                {{ persianNum($address->postal_code) }}
                              </li>
                            @endif
                            @if(!is_null($customer->mobile))
                              <li class="c-checkout-address__item-detail c-checkout-address__item-detail--phone">
                                {{ persianNum(0 . $customer->mobile) }}
                              </li>
                            @endif
                            <li class="c-checkout-address__item-detail c-checkout-address__item-detail--username">
                              {{ $customer->first_name . ' ' . $customer->last_name }}
                            </li>
                          </ul>
                          <div class="c-checkout-address__actions">
                            <button class="o-btn o-btn--link-blue-sm js-remove-address-btn" data-id="{{ $address->id }}"
                                    data-token="">حذف
                            </button>
{{--                            <button class="o-btn o-btn--link-blue-sm js-add-address-btn" data-event="edit_address"--}}
{{--                                    data-event-category="funnel"--}}
{{--                                    data-event-label="addresses: 2, position: list of addresses"--}}
{{--                                    data-id="{{ $address->id }}">ویرایش--}}
{{--                            </button>--}}
                          </div>
                        </div>
                      @endforeach
                      <button type="button" class="o-btn c-checkout-address__item c-checkout-address__item--new js-add-address-btn">
                        <span class="c-checkout-address__add-btn">
                          ایجاد آدرس جدید
                         </span>
                      </button>
                    </div>
                  </div>
                  @if (!is_null($store_addresses) && count($store_addresses))
                    <div class="js-ui-tab-content u-hidden" data-tab-content-id="dropOff">
                      <div class="c-checkout-address__shared-list">
                        <p class="o-hint o-hint--medium o-hint--text o-hint--neutral">
                          با انتخاب آدرس مرکز تحویل، می‌توانید با مراجعه به آدرس انتخاب شده، کالای خود را دریافت نمایید.
                        </p>

                        <div class="c-checkout-address__content c-checkout-address__content--shared">
                          @foreach($store_addresses as $key => $item)
                            @if ($customer->where('address_type', 'StoreAddress')->exists())
                              <?php $selected_store_address_id = $customer->delivery_address->id; ?>
                            @else
                              <?php $selected_store_address_id = null; ?>
                            @endif
                            <div class="c-checkout-address__item js-recipient-box js-user-address-container js-address-box js-dropoff-return {{ ($selected_store_address_id == $item->id)? 'is-selected' : '' }}"
                                 data-id="{{ $item->id }}" data-is-shared="true" data-event="change_address" data-event-category="funnel"
                                 data-event-label="addresses: {{ count($store_addresses) }}"
                                 data-address="{&quot;id&quot;:{{ $item->id }},&quot;default&quot;:true,&quot;title&quot;:&quot;xxxxxxx&quot;,&quot;address&quot;:&quot;xxxxxxx&quot;,&quot;description&quot;:&quot;xxxxxxx&quot;,&quot;fmcg_support&quot;:false,&quot;sort&quot;:0}"
                                 data-gtm-vis-recent-on-screen-9070001_346="4423"
                                 data-gtm-vis-first-on-screen-9070001_346="4423"
                                 data-gtm-vis-total-visible-time-9070001_346="100"
                                 data-gtm-vis-has-fired-9070001_346="1">
                              <div class="c-checkout-address__item-headline">
                                <label class="c-outline-radio">
                                  <input type="radio" name="address" {{ ($selected_store_address_id == $item->id)? 'checked' : '' }}>
                                  <span class="c-outline-radio__check"></span>
                                </label>
                                ارسال به این آدرس
                              </div>
                              <ul class="c-checkout-address__item-content">
                                <li class="c-checkout-address__item-address">
                                  {{ persianNum($item->address) }}
                                </li>
                                <li class="c-checkout-address__item-detail c-checkout-address__item-detail--username">
                                  {{ $customer->first_name . ' ' . $customer->last_name }}
                                </li>
                              </ul>
                              <div class="c-checkout-address__actions"></div>
                            </div>
                          @endforeach
                        </div>
                      </div>
                    </div>
                  @endif
                </div>
              </div>
              <form method="post" class="c-checkout-shipment__form" data-has-fresh="1" data-has-heavy="0" data-has-normal="1" data-multi-shipment="1" id="shipping-data-form">

                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                <input type="hidden" name="shipping[is_jet_delivery_enabled]" value="" id="js-jet-delivery-enabled-input"/>
                <input type="hidden" name="shipping[skipItemIds]" value="[1130176984,1130270410,1130270411,1130489950]" id="js-skip-item-id-input"/>

                <div class="js-normal-delivery ">
                  <div>
                    @foreach($weights as $i => $weight)

                      <?php
                        $has_consignment = false;
                        $i = 1;
                        $count = 0;
                      ?>

                      @foreach ($first_carts as $item)
                        @if ($item->product_variant()->first()->product->weight()->first()->id == $weight->id)
                          <?php $has_consignment = true; ?>
                        @endif
                      @endforeach

                      @if (isset($has_consignment) && $has_consignment)
                        <div class="c-checkout-pack js-checkout-pack " data-parcel="0-1-1">
                          <div class="c-checkout-pack__header">
                            <div class="c-checkout-pack__header-title">
                              <span>مرسوله{{ persianNum($i) }} از {{ persianNum($cons_count) }}</span>
                            </div>
                            <div class="c-checkout-pack__header-dsc">
                              <span>
                              {{ persianNum($first_carts->count()) }}
                              کالا
                            </span>
{{--                            <span class="c-checkout-time-table__shipping-lead-time">--}}
{{--                              موجود در انبار دیجی‌کالا--}}
{{--                            </span>--}}
                            </div>
                          </div>
                          <div class="c-checkout-pack__shipping-type-row">
                            <?php $sum_weight = 0; ?>
                            @foreach ($first_carts as $key => $cart)
                              @if ($cart->product_variant()->first()->product->weight()->first()->id == $weight->id)
                                <?php $sum_weight += $cart->product_variant()->first()->product->weight; ?>
                                @if ($first_carts->count()-1 == $key)
                                    @if ($weight->deliveryMethods()->exists())
                                      @foreach($weight->deliveryMethods()->where('status', 'active')->get() as $key => $method)
                                        @if($sum_weight > 5000 && $method->id == 1)
                                          @continue
                                        @endif
                                        <?php $availible_methods[] = $method->id; ?>

                                        <?php
                                          if(in_array(1, $availible_methods)){
                                            $default_method = 1;
                                          }
                                          elseif (in_array(2, $availible_methods)) {
                                            $default_method = 2;
                                          }
                                          elseif (in_array(3, $availible_methods)) {
                                            $default_method = 3;
                                          }
                                          else {
                                           $default_method = 4;
                                          }

                                        ?>

                                          <label class="c-checkout-pack__shipping-type-item">
                                          <input type="radio" value="{{ $method->id }}" class="js-shipping-type-selector" data-weight="{{ $weight->id }}" name="shipping-type-normal-0-0-{{ $i }}"
                                            {{ ($default_method == $method->id)? 'checked="checked"' : '' }}
                                          >
                                          <div class="c-checkout-pack__shipping-type">
                                            <div class="c-checkout-time-table__shipping-type">
                                              <span style="background-image: url({{ full_media_path($method->media()->first()) }}); width: 25px !important;height: 19px !important; float: right; background-repeat: no-repeat; background-size: 20px; background-position: right bottom; margin-left: 0px;"></span>
                                              {{ $method->name }}
                                            </div>
                                          </div>
                                        </label>
                                      @endforeach
                                    @endif
                                @endif
                              @endif
                            @endforeach
                          </div>
                          <div class="c-checkout-pack__row">
                            <script>
                              var carouselDataTracker = null;
                              if (carouselDataTracker) {
                                if (!window.carouselData)
                                  window.carouselData = [carouselDataTracker];
                                else
                                  window.carouselData.push(carouselDataTracker);
                              }
                            </script>
                            <section class="c-swiper c-swiper--products-compact js-swiper-box-container">
                              <div class="c-box">
                                <div class="swiper-container swiper-container-horizontal js-swiper-container js-swiper-cart-parcel swiper-container-rtl">
                                  <div class="swiper-wrapper" style="transform: translate3d(0px, 0px, 0px);">

                                    @foreach ($first_carts as $cart)
                                      @if ($cart->product_variant()->first()->product->weight()->first()->id == $weight->id)
                                        <div class="swiper-slide js-product-box-container" data-item-id="{{ $cart->id }}" style="width: 154.167px;">
                                          <div class="c-product-box c-product-box--compact js-product-box">
                                            <a class="c-product-box__img js-url">
                                              <?php $product = $cart->product_variant()->first()->product; ?>
                                              @foreach($product->media as $image)
                                                @if($product->media && ($image->pivot->is_main == 1))
                                                  <img class="swiper-lazy swiper-lazy-loaded" alt="{{ $cart->product_variant()->first()->product->title_fa }}" src="{{ $site_url . '/' .  $cart->product_variant()->first()->product->media()->first()->path . '/' . $cart->product_variant()->first()->product->media()->first()->name }}?x-oss-process=image/resize,m_lfit,h_350,w_350/quality,q_60">
                                                @endif
                                              @endforeach
                                            </a>
                                            <div class="c-product-box__variant c-product-box__variant--color">
                                              @if (!is_null($cart->product_variant()->first()->variant->value))
                                              <span style="background-color: {{ $cart->product_variant()->first()->variant->value }};"></span>
                                              @endif
                                              {{ $cart->product_variant()->first()->variant->name }}
                                            </div>
                                          </div>
                                        </div>
                                      @endif
                                    @endforeach

                                    {{--                                    <div class="swiper-slide js-product-box-container swiper-slide-active" data-item-id="1141159823" style="width: 154.167px;">--}}
{{--                                      <div class="c-product-box c-product-box--compact js-product-box">--}}
{{--                                        <a class="c-product-box__img js-url">--}}
{{--                                          <img alt="لپ تاپ 15 اینچی لنوو مدل Ideapad 330 - E" class="swiper-lazy swiper-lazy-loaded" src="https://dkstatics-public.digikala.com/digikala-products/4209444.jpg?x-oss-process=image/resize,m_lfit,h_350,w_350/quality,q_60">--}}
{{--                                        </a>--}}
{{--                                        <div class="c-product-box__variant c-product-box__variant--color">--}}
{{--                                          <span style="background-color: #212121;"></span>--}}
{{--                                          مشکی--}}
{{--                                        </div>--}}
{{--                                      </div>--}}
{{--                                    </div>--}}
{{--                                    <div class="swiper-slide js-product-box-container swiper-slide-next" data-item-id="1141161050" style="width: 154.167px;">--}}
{{--                                      <div class="c-product-box c-product-box--compact js-product-box">--}}
{{--                                        <a class="c-product-box__img js-url">--}}
{{--                                          <img alt="ظرف پودر رختشویی طرح ماشین لباس شویی مدل W23" class="swiper-lazy swiper-lazy-loaded" src="https://dkstatics-public.digikala.com/digikala-products/054e9141e62cb5e052a64991df2aecfa651f5a04_1606049057.jpg?x-oss-process=image/resize,m_lfit,h_350,w_350/quality,q_60">--}}
{{--                                        </a>--}}
{{--                                        <div class="c-product-box__variant c-product-box__variant--color">--}}
{{--                                          <span style="background-color: #FF80AB;"></span>--}}
{{--                                          صورتی--}}
{{--                                        </div>--}}
{{--                                      </div>--}}
{{--                                    </div>--}}
                                  </div>
                                  <div class="swiper-button-prev js-swiper-button-prev swiper-button-disabled"></div>
                                  <div class="swiper-button-next js-swiper-button-next swiper-button-disabled"></div>
                                </div>
                              </div>
                            </section>
                          </div>




                        </div>
                        <?php $i++; ?>
                      @endif

                    @endforeach
                  </div>
                </div>

                <div class="c-checkout-shipment__invoice-type">
                  <input type="hidden" name="is_legal" value="0"/>
                  <p class="c-checkout-shipment__invoice-type-info">
                    شما می‌توانید فاکتور خرید را پس از تحویل سفارش از بخش جزییات سفارش در حساب کاربری خود دریافت کنید.
                  </p>
                </div>
              </form>
            </div>
            <div class="c-checkout__actions">
              <a href="/cart/" class="c-checkout__actions--back" data-snt-event='dkShippingPageClick' data-snt-params='{"item":"back_to_cart","item_option":null}' data-event="back_to_cart_link" data-event-category="funnel" data-event-label="items: 4, addresses: 2">
                  بازگشت به سبد خرید
              </a>
            </div>
          </section>
          <aside class="o-page__aside  js-sticky-cart">

            <div class="c-checkout-aside js-checkout-aside">
              <div class="c-checkout-bill">
                <ul class="c-checkout-bill__summary">
                  <?php $sum_sale_price = 0; ?>
                  @foreach($first_carts as $priceItem)
                    <?php $sum_sale_price += ($priceItem->new_sale_price * $priceItem->count); ?>
                  @endforeach
                  <li>
        <span class="c-checkout-bill__item-title">
          قیمت کالاها
          ({{ persianNum($first_carts->count()) }})
        </span>
                    <span class="c-checkout-bill__price">
          {{ persianNum(number_format(toman($sum_sale_price))) }}
          <span class="c-checkout-bill__currency">
              تومان
          </span>
        </span>
        </li>

      <?php $sum_promotion_price = 0; ?>
      @foreach($first_carts as $priceItem)
          @if ($priceItem->new_sale_price > $priceItem->new_promotion_price)
              <?php $sum_promotion_price += (($priceItem->new_sale_price - $priceItem->new_promotion_price) * $priceItem->count); ?>
          @endif
      @endforeach

        @if($first_carts->sum('new_promotion_price') > 0)
          <li>
            <span class="c-checkout-bill__item-title">
                تخفیف کالاها
            </span>
            <span class="c-checkout-bill__price c-checkout-bill__price--discount">
              <span>
                ({{ persianNum(number_format(($sum_promotion_price / $sum_sale_price) * 100)) }}٪)
              </span>
                {{ persianNum(number_format(toman($sum_promotion_price))) }}
              <span class="c-checkout-bill__currency"> تومان </span>
            </span>
          </li>

        @endif

      <li class="c-checkout-bill__sum-price">
        <span class="c-checkout-bill__item-title">
            جمع
        </span>
        <span class="c-checkout-bill__price">
          {{ isset($sum_promotion_price) ? persianNum(number_format(toman($sum_sale_price - $sum_promotion_price))) :  persianNum(toman($sum_sale_price)) }}
          <span class="c-checkout-bill__currency">
              تومان
          </span>
        </span>
                  </li>
                  <li>
                    <div class="c-checkout-bill__item-title">
          <span>
            هزینه ارسال
          </span>

                      <div class="c-checkout-bill__shipping-history js-normal-delivery ">
                        {{ persianNum($cons_count) }} مرسوله
                        <div class="c-checkout-bill__shipping-history-container">
                          <?php
                          $m = 1;
                          $sum_shipping_cost = 0;
                          ?>
                          @foreach($consignment_shipping_cost as $key => $item)
                            <?php
                            $delivery_method = \Modules\Staff\Shiping\Models\DeliveryMethod::find($method_ids[$m-1]);
                            $sum_shipping_cost =+ $item;
                            ?>
                            <div class="c-checkout-bill__shipping-history-row ">
                              <span style="float: right;">مرسوله {{ persianNum($m) }} </span>
                              {{--                  <span class="c-checkout-bill__shipping-history-title js-package-row-title">--}}
                              {{--                    <span style="background-image: url({{ $site_url . '/' .  $delivery_method->media()->first()->path . '/' . $delivery_method->media()->first()->name }});width: 25px !important;height: 19px !important;float: right;background-repeat: no-repeat;background-size: 18px;margin-left: 0px;margin-top: 2px;"></span>--}}
                              {{--                  </span>--}}
                              <span>{{ $delivery_method->name }}</span>
                              </span>
                              <span class="c-checkout-bill__shipping-history-title js-package-row-alt-title u-hidden">
                     {{ persianNum($m) }}
                    <span class="c-checkout-bill__shipping-history-title--altShipping">
                       {{ $delivery_method->name }}
                    </span>
                  </span>
                              <span class="c-checkout-bill__shipping-history-price c-checkout-bill__shipping-history-price--free-plus c-digiplus-sign--after js-package-row-plus-free-amount u-hidden"><span class="c-checkout__plus-delivery-counter">
                                   از ۰
                              </span>
                    رایگان پلاس
                  </span>
                              <span class="c-checkout-bill__shipping-history-price js-package-row-non-free-amount">
                    <span class="c-checkout-bill__shipping-history-price--amount js-package-row-amount">
                      {{ persianNum(number_format(toman($item))) }}
                    </span>
                    <span class="c-checkout-bill__shipping-history-price--currency">
                      تومان
                    </span>
                  </span>
                              <span class="c-checkout-bill__shipping-history-price--free js-package-row-free-amount u-hidden">
                    رایگان
                  </span>
                            </div>
                            <?php $m++; ?>
                          @endforeach
                        </div>
                      </div>

                    </div>
                    @if ($sum_shipping_cost == 0)
                      <span class="c-checkout-bill__item-title js-free-shipping">
            رایگان
          </span>
                    @elseif($sum_shipping_cost !== -1)
                      <span class="c-checkout-bill__item-title js-not-free-shipping">
                        <span class="js-shipping-cost"> {{ persianNum(number_format(toman($sum_shipping_cost))) }} </span>
                        &nbsp;تومان
                      </span>
                    @endif
                    @if (in_array(-1, $consignment_shipping_cost) && $sum_shipping_cost !== 0 && $sum_shipping_cost !== -1)
                      <span class="c-checkout-bill__item-title js-shipping-divider"> + </span>
                    @endif
                    @if(in_array(-1, $consignment_shipping_cost))
                      <span class="c-checkout-bill__item-title js-shipping-post-paid">پس کرایه</span>
                    @endif
                  </li>
                  <li class="c-checkout-bill__shipping-cost-notice js-dynamic-shipping-cost-notice">
                    هزینه بر اساس وزن و حجم مرسوله تعیین شده است.
                  </li>
                  <li class="c-checkout-bill__total-price">
                    <span class="c-checkout-bill__total-price--title">
                      مبلغ قابل پرداخت
                    </span>
                    <span class="c-checkout-bill__total-price--amount" id="cartPayablePrice">
                      <?php
                        $final_sum_price = toman($sum_sale_price - $sum_promotion_price + $sum_shipping_cost);
                      ?>
                      <span class="js-price" data-price="{{ $final_sum_price }}"> {{ persianNum(number_format($final_sum_price)) }} </span>
                      <span class="c-checkout-bill__total-price--currency">
                        تومان
                      </span>
                    </span>
                  </li>
                  <li class="c-checkout-bill__to-forward-button">
                    <a class="o-btn o-btn--full-width o-btn--contained-red-lg js-save-shipping-data" style="pointer-events: all; cursor: pointer;">
                      ادامه فرآیند خرید
                    </a>
                  </li>
                </ul>
              </div>
            </div>

          </aside>
        </div>
      </section>
    </div>
    <div class="remodal c-modal c-modal--no-bottom-padding js-address-modal" data-remodal-id="add-edit-address"
         role="dialog" aria-labelledby="modalTitle" tabindex="-1z" aria-describedby="modalDesc"
         data-remodal-options="closeOnOutsideClick: false">
      <div class="c-modal__top-bar  ">
        <div class="c-modal__title js-address-modal-title">افزودن آدرس</div>
        <div class="c-modal__close" data-remodal-action="close"></div>
      </div>
      <form method="post" id="add-edit-address-form">
        <div class="c-address__modal-content js-map-interactive" id="address-modal-map">
          <div class="c-map__address-container js-map-address-container u-hidden">
            <div class="c-map__address-title">برای ادامه دادن فرآیند خرید موقعیت آدرس زیر را بر روی نقشه تعیین کنید:
            </div>
            <div class="c-map__address js-map-address"></div>
          </div>
          <div class="c-map__container  js-map-container">
            <div class="c-map " id="map" data-current-icon="https://www.digikala.com/static/files/c1d18c6c.png"></div>
            <div class="c-map__search-field">
              <input class="js-search-map-input" placeholder="جستجو آدرس">
              <button type="button" class="o-btn c-map__search-cancel js-search-map-cancel u-hidden"></button>
            </div>
            <div class="c-map__search-content">
              <div class="c-map__search-content-list js-search-map-content"></div>
            </div>
            <input type="hidden" name="address[lat]">
            <input type="hidden" name="address[lng]">
            <div class="c-map__overlay"></div>
            <div class="c-map__marker">
              <img src="https://www.digikala.com/static/files/7ab27ed3.svg"/>
            </div>
          </div>
          <div class="c-address__modal-footer">
            <div class="c-address__modal-footer-title">مرسوله شما به این موقعیت ارسال خواهد شد.</div>
            <div class="o-btn o-btn--contained-red-md js-select-address-map">ثبت و افزودن جزییات</div>
          </div>
        </div>
        <div class="c-address__modal-content u-hidden" id="address-modal-form">
          <div class="c-address__separator"></div>
          <div class="c-address__form">
            <div class="c-address__form-row">
              <div class="o-form__field-container">
                <div class="o-form__field-label">استان*</div>
                <select
                  class="c-ui-select js-ui-select-search js-dropdown-universal js-select-state js-address-state-id"
                  name="address[state_id]" value="">
                  <option value="">انتخاب استان</option>
                  @foreach($states->where('type', 'state') as $state)
                    <option value="{{ $state->id }}">{{ $state->name }}</option>
                  @endforeach
                </select>
              </div>
              <div class="o-form__field-container">
                <div class="o-form__field-label">شهر*</div>
                <select class="c-ui-select js-ui-select-search js-dropdown-universal js-select-city js-address-city-id"
                        name="address[city_id]" value="">
                  <option value="">انتخاب شهر</option>
                </select>
              </div>
            </div>
            <div class="c-address__form-row js-district-wrapper">
              <div class="o-form__field-container">
                <div class="o-form__field-label">محله*</div>
                <select
                  class="c-ui-select js-ui-select-search js-dropdown-universal js-select-district js-address-district-id"
                  name="address[district_id]" value="">
                  <option value="">انتخاب محله</option>
                </select>
              </div>
            </div>
            <div class="c-address__form-row c-address__form-row--full-width js-address-field">
              <label class="o-form__field-container">
                <div class="o-form__field-label">نشانی پستی*</div>
                <div class="o-form__field-frame">
                  <input name="address[address]" type="" placeholder="" value=""
                         class="o-form__field js-input-field js-address-address"/>
                </div>
              </label>
            </div>
            <div class="c-address__form-row">
              <div class="c-address__form-row">
                <label class="o-form__field-container">
                  <div class="o-form__field-label">پلاک*</div>
                  <div class="o-form__field-frame">
                    <input name="address[bld_num]" type="" placeholder="" value=""
                           class="o-form__field js-input-field js-address-building-number"/>
                  </div>
                </label>
                <label class="o-form__field-container">
                  <div class="o-form__field-label">واحد</div>
                  <div class="o-form__field-frame">
                    <input name="address[apt_id]" type="" placeholder="" value=""
                           class="o-form__field js-input-field js-address-apartment-number"/>
                  </div>
                </label>
              </div>
              <div class="c-address__form-row">
                <label class="o-form__field-container">
                  <div class="o-form__field-label">کد پستی*</div>
                  <div class="o-form__field-frame">
                    <input name="address[post_code]" type="" placeholder="" value=""
                           class="o-form__field js-input-field js-address-postal-code"/>
                  </div>
                  <div class="o-form__field-helper">کدپستی باید ۱۰ رقم و بدون خط تیره باشد</div>
                </label>
              </div>
            </div>
          </div>
          <div class="c-address__form">
            <div class="c-address__form-row c-address__form-row--full-width js-recipient-is-me-container">
              <label class="o-form__check-box">
                <input class="o-form__check-box-input js-recipient-is-me" name="address[recipient_is_self]" value="true"
                       type="checkbox">
                <span class="o-form__check-box-sign"></span>
                <span class="js-ui-checkbox-label">
                  گیرنده سفارش خودم هستم
                </span>
              </label>
            </div>
            <div class="c-address__form-row">
              <input type="hidden" class="js-address-id">
              <label class="o-form__field-container">
                <div class="o-form__field-label">نام گیرنده*</div>
                <div class="o-form__field-frame">
                  <input name="address[first_name]" type="" placeholder="" value=""
                         class="o-form__field js-input-field js-address-first-name"/>
                </div>
              </label>
              <label class="o-form__field-container">
                <div class="o-form__field-label">نام خانوادگی گیرنده*</div>
                <div class="o-form__field-frame">
                  <input name="address[last_name]" type="" placeholder="" value=""
                         class="o-form__field js-input-field js-address-last-name"/>
                </div>
              </label>
            </div>
            <div class="c-address__form-row">
              <label class="o-form__field-container">
                <div class="o-form__field-label">کد ملی گیرنده*</div>
                <div class="o-form__field-frame">
                  <input name="address[national_id]" type="" placeholder="" value=""
                         class="o-form__field js-input-field js-address-national-id"/>
                </div>
                <div class="o-form__field-helper">کد ملی باید ۱۰ رقم و بدون خط تیره باشد</div>
              </label>
              <label class="o-form__field-container">
                <div class="o-form__field-label">شماره موبایل*</div>
                <div class="o-form__field-frame">
                  <input name="address[mobile_phone]" type="" placeholder="" value=""
                         class="o-form__field js-input-field js-address-mobile-phone"/>
                </div>
                <div class="o-form__field-helper">مثل: ۰۹۱۲۳۴۵۶۷۸۹</div>
              </label>
            </div>
          </div>
          <div class="c-address__separator"></div>
          <div class="c-address__modal-footer">
            <div class="o-btn o-btn--link-blue-sm js-back-to-map">اصلاح موقعیت بر روی نقشه</div>
            <button class="o-btn o-btn--contained-red-md js-submit-btn" type="submit">تایید و ثبت آدرس</button>
          </div>
        </div>
      </form>
    </div>
    <div class="remodal c-remodal-delivery-limit" data-remodal-id="separate-products" role="dialog" aria-labelledby="modal1Title" aria-describedby="modal1Desc">
      <button data-remodal-action="close" class="remodal-close" aria-label="Close"></button>
      <div class="c-remodal-delivery-limit__headline">محدودیت ارسال</div>
      <div class="c-remodal-delivery-limit__content">
        <div class="container">
          <div class="c-remodal-delivery-limit__products">
            {{--            <script>--}}
            {{--              var carouselDataTracker = null;--}}
            {{--              if (carouselDataTracker) {--}}
            {{--                if (!window.carouselData)--}}
            {{--                  window.carouselData = [carouselDataTracker];--}}
            {{--                else--}}
            {{--                  window.carouselData.push(carouselDataTracker);--}}
            {{--              }--}}
            {{--            </script>--}}
            <section class="c-swiper c-swiper--products-compact js-swiper-box-container">
              <div class="o-headline c-product-box__container-header">
                <div><span class="c-product-box__container-title">اولین بازه ارسال</span><span
                    class="c-product-box__container-due">(سه شنبه ۱۳ تیرماه)</span></div>
                <div class="c-product-box__container-cost">
                  هزینه ارسال:
                  ۱,۳۵۰تومان
                </div>
              </div>
              <div class="c-box">
                <div
                  class="swiper-container swiper-container-horizontal js-swiper-container js-swiper-separated-parcel">
                  <div class="swiper-wrapper">
                    <div class="swiper-slide js-product-box-container">
                      <div class="c-product-box c-product-box--compact js-product-box">
                        <a class="c-product-box__img js-url">
                          <img data-src-swiper="" alt="" class="swiper-lazy"></a>
                        <div class="c-product-box__title"></div>
                      </div>
                    </div>
                    <div class="swiper-slide js-product-box-container">
                      <div class="c-product-box c-product-box--compact js-product-box">
                        <a class="c-product-box__img js-url">
                          <img data-src-swiper="" alt="" class="swiper-lazy">
                        </a>
                        <div class="c-product-box__title"></div>
                      </div>
                    </div>
                    <div class="swiper-slide js-product-box-container">
                      <div class="c-product-box c-product-box--compact js-product-box">
                        <a class="c-product-box__img js-url">
                          <img data-src-swiper="" alt="" class="swiper-lazy">
                        </a>
                        <div class="c-product-box__title"></div>
                      </div>
                    </div>
                  </div>
                  <div class="swiper-button-prev js-swiper-button-prev"></div>
                  <div class="swiper-button-next js-swiper-button-next"></div>
                </div>
              </div>
            </section>
          </div>
          <div class="c-remodal-delivery-limit__products">
            <script>
              var carouselDataTracker = null;
              if (carouselDataTracker) {
                if (!window.carouselData)
                  window.carouselData = [carouselDataTracker];
                else
                  window.carouselData.push(carouselDataTracker);
              }
            </script>
            <section class="c-swiper c-swiper--products-compact js-swiper-box-container">
              <div class="o-headline c-product-box__container-header">
                <div><span class="c-product-box__container-title">اولین بازه ارسال</span><span
                    class="c-product-box__container-due">(سه شنبه ۱۳ تیرماه)</span></div>
                <div class="c-product-box__container-cost">
                  هزینه ارسال:
                  ۱,۳۵۰تومان
                </div>
              </div>
              <div class="c-box">
                <div
                  class="swiper-container swiper-container-horizontal js-swiper-container js-swiper-separated-parcel">
                  <div class="swiper-wrapper">
                    <div class="swiper-slide js-product-box-container">
                      <div class="c-product-box c-product-box--compact js-product-box">
                        <a class="c-product-box__img js-url">
                          <img data-src-swiper="" alt="" class="swiper-lazy"></a>
                        <div class="c-product-box__title"></div>
                      </div>
                    </div>
                    <div class="swiper-slide js-product-box-container">
                      <div class="c-product-box c-product-box--compact js-product-box">
                        <a class="c-product-box__img js-url">
                          <img data-src-swiper="" alt="" class="swiper-lazy"></a>
                        <div class="c-product-box__title"></div>
                      </div>
                    </div>
                    <div class="swiper-slide js-product-box-container">
                      <div class="c-product-box c-product-box--compact js-product-box">
                        <a class="c-product-box__img js-url">
                          <img data-src-swiper="" alt="" class="swiper-lazy">
                        </a>
                        <div class="c-product-box__title"></div>
                      </div>
                    </div>
                  </div>
                  <div class="swiper-button-prev js-swiper-button-prev"></div>
                  <div class="swiper-button-next js-swiper-button-next"></div>
                </div>
              </div>
            </section>
          </div>
          <div class="c-remodal-delivery-limit__actions">
            <button class="c-remodal-delivery-limit__proceed-btn">ارسال زودتر کالاها</button>
            <button class="c-remodal-delivery-limit__abort-btn">بازگشت</button>
          </div>
        </div>
      </div>
    </div>
    <div class="remodal c-modal c-modal--sm c-remodal-delivery-limit" data-remodal-id="delivery-limit" role="dialog" aria-labelledby="modalTitle" tabindex="-1z" aria-describedby="modalDesc" data-remodal-options="">
      <div class="c-modal__top-bar  c-modal__top-bar--has-line">
        <div class="c-modal__title ">محدودیت ارسال کالا</div>
      </div>
      <div class="c-remodal-delivery-limit__container">
        <p class="js-invalid-items-message"></p>
        <div class="c-remodal-delivery-limit__products js-invalid-items">
          <div class="swiper-container swiper-container-horizontal js-swiper-delivery-limit">
            <div class="swiper-wrapper"></div>
            <div class="swiper-button-prev js-swiper-button-prev"></div>
            <div class="swiper-button-next js-swiper-button-next"></div>
          </div>
        </div>
      </div>
      <div class="c-remodal-delivery-limit__footer">
        <button type="button" class="o-btn o-btn--outlined-red-md js-choose-address">
          تغییر آدرس
        </button>
        <a href="/shipping/remove/invalid-items/" class="o-btn o-btn--outlined-red-md">
          حذف این کالاها
        </a>
      </div>
    </div>
  </div>
  <div id="sidebar">
    <aside></aside>
  </div>
</main>
<div class="remodal c-remodal-account" data-remodal-id="login" role="dialog" aria-labelledby="modal1Title" aria-describedby="modal1Desc">
  <button data-remodal-action="close" class="remodal-close" aria-label="Close"></button>
  <div class="c-remodal-account__headline">ورود به {{ $fa_store_name }}</div>
  <div class="c-remodal-account__content">
    <form class="c-form-account" id="loginFormModal">
      <div class="c-message-light c-message-light--info" id="login-form-msg"></div>
      <div class="c-form-account__title">پست الکترونیک یا شماره موبایل</div>
      <div class="c-form-account__row">
        <div class="c-form-account__col">
          <label class="c-ui-input c-ui-input--account-login">
            <input class="c-ui-input__field" type="text" name="login[email_phone]" autocomplete="current-email"
                   placeholder="{{ $customer->email }}">
          </label>
        </div>
      </div>
      <div class="c-form-account__title">کلمه عبور</div>
      <div class="c-form-account__row">
        <div class="c-form-account__col">
          <label class="c-ui-input c-ui-input--account-password">
            <input class="c-ui-input__field" name="login[password]" type="password" autocomplete="current-password"
                   placeholder="">
          </label>
        </div>
      </div>
      <div class="c-form-account__agree">
        <label class="c-ui-checkbox c-ui-checkbox--primary">
          <input type="checkbox" value="1" name="login[remember]" id="accountAutoLogin">
          <span class="c-ui-checkbox__check"></span>
        </label>
        <label for="accountAutoLogin">مرا به خاطر داشته باش</label>
      </div>
      <div class="c-form-account__row c-form-account__row--submit">
        <div class="c-form-account__col">
          <button class="btn-login login-button-js">ورود به {{ $fa_store_name }}</button>
        </div>
      </div>
      <div class="c-form-account__link">
        <a data-snt-event="dkLoginClick" data-snt-params='{"type":"forgetPassword","site":"login-modal"}'
           href="{{ route('customer.forgotPage') }}" class="btn-link-spoiler">رمز عبور خود را فراموش کرده‌ام</a>
      </div>
      <div class="c-message-light c-message-light--error has-oneline" id="loginFormError">
        نام کاربری یا کلمه عبور اشتباه است.
      </div>
    </form>
  </div>
  <div class="c-remodal-account__footer is-highlighted">
    <span>کاربر جدید هستید؟</span>
    <a data-snt-event="dkLoginClick" data-snt-params='{"type":"signup","site":"login-modal"}'
       href="{{ route('customer.regLoginPage') }}" class="btn-link-spoiler">ثبت‌نام در {{ $fa_store_name }}</a>
  </div>
</div>
<div class="remodal c-remodal-loader" data-remodal-id="loader" data-remodal-options="hashTracking: false, closeOnOutsideClick: false" role="dialog" aria-labelledby="modal1Title" aria-describedby="modal1Desc">
  <div class="c-remodal-loader__icon">
    <svg xmlns="http://www.w3.org/2000/svg" width="115" height="30" viewBox="0 0 115 30">
      <path fill="#EE384E" fill-rule="evenodd"
            d="M76.916 19.024h6.72v-8.78h-6.72c-1.16 0-2.24 1.061-2.24 2.195v4.39c0 1.134 1.08 2.195 2.24 2.195zm26.883 0h6.72v-8.78h-6.72c-1.16 0-2.24 1.061-2.24 2.195v4.39c0 1.134 1.08 2.195 2.24 2.195zM88.117 6.951v15.366c0 .484-.625 1.098-1.12 1.098l-2.24.023c-.496 0-1.12-.637-1.12-1.12v-.733l-1.017 1.196c-.31.413-1.074.634-1.597.634h-4.107c-3.604 0-6.721-3.063-6.721-6.586v-4.39c0-3.523 3.117-6.585 6.72-6.585h10.082c.495 0 1.12.613 1.12 1.097zm26.883 0v15.366c0 .484-.624 1.098-1.12 1.098l-2.24.023c-.496 0-1.12-.637-1.12-1.12v-.733l-1.017 1.196c-.31.413-1.074.634-1.597.634h-4.107c-3.604 0-6.721-3.063-6.721-6.586v-4.39c0-3.523 3.117-6.585 6.72-6.585h10.082c.495 0 1.12.613 1.12 1.097zm-74.675 3.293h-6.721c-1.16 0-2.24 1.061-2.24 2.195v4.39c0 1.134 1.08 2.195 2.24 2.195h6.72v-8.78zm4.48-3.293V23.78c0 3.523-3.117 6.22-6.72 6.22H34.62c-.515 0-1-.236-1.311-.638l-1.972-2.55c-.327-.424-.144-1.202.399-1.202h6.347c1.16 0 2.24-.696 2.24-1.83v-.365h-6.72c-3.604 0-6.72-3.063-6.72-6.586v-4.39c0-3.523 3.116-6.585 6.72-6.585h4.107c.514 0 1.074.405 1.437.731l1.177 1.098V6.95c0-.483.625-1.097 1.12-1.097h2.24c.496 0 1.12.613 1.12 1.097zM4.481 16.83c0 1.134 1.08 2.195 2.24 2.195h6.72v-8.78h-6.72c-1.16 0-2.24 1.061-2.24 2.195v4.39zM16.8 0c.497 0 1.121.613 1.121 1.098v21.22c0 .483-.624 1.097-1.12 1.097h-2.24c-.496 0-1.12-.613-1.12-1.098v-.732l-1.175 1.232c-.318.346-.932.598-1.44.598H6.722C3.117 23.415 0 20.352 0 16.829v-4.356c0-3.523 3.117-6.62 6.72-6.62h6.722V1.099c0-.485.624-1.098 1.12-1.098h2.24zm46.3 14.634L69.336 6.9c.347-.421.04-1.048-.513-1.048h-3.566c-.27 0-.525.119-.696.323l-6.314 7.727V1.098c0-.485-.625-1.098-1.12-1.098h-2.24c-.496 0-1.12.613-1.12 1.098v21.22c0 .483.624 1.097 1.12 1.097h2.24c.495 0 1.12-.614 1.12-1.098v-6.951l6.317 7.744c.17.207.428.328.7.328h3.562c.554 0 .86-.627.514-1.048l-6.24-7.756zM48.166 0c-.496 0-1.12.613-1.12 1.098v2.195c0 .484.624 1.097 1.12 1.097h2.24c.495 0 1.12-.613 1.12-1.097V1.098c0-.485-.625-1.098-1.12-1.098h-2.24zm0 5.854c-.496 0-1.12.613-1.12 1.097v15.366c0 .484.8 1.12 1.295 1.12l2.065-.022c.495 0 1.12-.614 1.12-1.098V6.951c0-.484-.625-1.097-1.12-1.097h-2.24zM21.282 0c-.495 0-1.12.613-1.12 1.098v2.195c0 .484.625 1.097 1.12 1.097h2.24c.496 0 1.12-.613 1.12-1.097V1.098c0-.485-.624-1.098-1.12-1.098h-2.24zm0 5.854c-.495 0-1.12.613-1.12 1.097v15.366c0 .484.625 1.098 1.12 1.098h2.24c.496 0 1.12-.614 1.12-1.098V6.951c0-.484-.624-1.097-1.12-1.097h-2.24zm73.556-4.756v21.22c0 .483-.625 1.097-1.12 1.097h-2.24c-.496 0-1.12-.614-1.12-1.098V1.097c0-.484.624-1.097 1.12-1.097h2.24c.495 0 1.12.613 1.12 1.098z"/>
    </svg>
  </div>
  <div class="c-remodal-loader__bullets">
    <i class="c-remodal-loader__bullet c-remodal-loader__bullet--1"></i>
    <i class="c-remodal-loader__bullet c-remodal-loader__bullet--2"></i>
    <i class="c-remodal-loader__bullet c-remodal-loader__bullet--3"></i>
    <i class="c-remodal-loader__bullet c-remodal-loader__bullet--4"></i>
  </div>
</div>
<div class="remodal c-remodal-general-alert" data-remodal-id="alert" role="dialog" aria-labelledby="modal1Title" aria-describedby="modal1Desc">
  <div class="c-remodal-general-alert__main">
    <div class="c-remodal-general-alert__content">
      <p class="js-remodal-general-alert__text"></p>
      <p class="c-remodal-general-alert__description js-remodal-general-alert__description"></p>
    </div>
    <div class="c-remodal-general-alert__actions">
      <button
        class="c-remodal-general-alert__button c-remodal-general-alert__button--approve js-remodal-general-alert__button--approve"></button>
      <button
        class="c-remodal-general-alert__button c-remodal-general-alert__button--cancel js-remodal-general-alert__button--cancel"></button>
    </div>
  </div>
</div>
<div class="remodal c-remodal-general-information" data-remodal-id="information" role="dialog" aria-labelledby="modal1Title" aria-describedby="modal1Desc">
  <div class="c-remodal-general-information__main">
    <div class="c-remodal-general-information__content">
      <p class="js-remodal-general-information__text"></p>
    </div>
    <div class="c-remodal-general-information__actions">
      <button
        class="c-remodal-general-information__button c-remodal-general-information__button--approve js-remodal-general-information__button--approve"></button>
    </div>
  </div>
</div>
<div class="remodal c-remodal c-remodal-quick-view" data-remodal-id="quick-view" role="dialog" aria-labelledby="modal1Title" aria-describedby="modal1Desc">
  <button data-remodal-action="close" class="remodal-close c-remodal__close" aria-label="Close"></button>
  <div class="c-quick-view__content js-quick-view-section"></div>
</div>
<div class="remodal c-remodal-fmcg" data-remodal-id="fmcg-modal" data-remodal-options="hashTracking: false, closeOnOutsideClick: false" role="dialog">
  <button data-remodal-action="close" class="remodal-close" aria-label="Close"></button>
  <div class="c-remodal-fmcg__container">
    <img src="https://www.digikala.com/static/files/cbaed462.png" class="c-remodal-fmcg__logo"/>
    <div class="c-remodal-fmcg__content">
      <p class="c-remodal-fmcg__head-text">ارسال سریع کالای <span> سوپر مارکتی </span> فقط در تهران و کرج امکان پذیر
        است.</p>
      <p class="c-remodal-fmcg__question">با توجه به محدودیت ارسال، آیا مایل هستید این کالا به سبد خرید شما افزوده
        شود؟</p>
      <div class="c-remodal-fmcg__actions">
        <button class="c-remodal-fmcg__button c-remodal-fmcg__button--reject js-fmcg-modal-reject">خیر</button>
        <button class="c-remodal-fmcg__button c-remodal-fmcg__button--approve js-fmcg-modal-approve">بله</button>
      </div>
    </div>
  </div>
</div>
<div class="c-toast__container js-toast-container">
  <div class="c-toast js-toast" style="display: none">
    <div class="c-toast__text js-toast-text"></div>
    <div class="c-toast__btn-container">
      <button type="button" class="js-toast-btn o-link o-link--sm o-link--no-border o-btn">
        متوجه شدم
      </button>
    </div>
  </div>
</div>
<div class="remodal c-remodal-location js-general-location" data-remodal-id="general-location" role="dialog" aria-labelledby="modal1Title" aria-describedby="modal1Desc">
  <div class="c-remodal-location__header">
    <span class="js-general-location-title">انتخاب استان</span>
    <div class="c-remodal-location__close js-close-modal"></div>
  </div>
  <div class="c-remodal-location__content js-states-container">
    <div class="c-general-location__row c-general-location__row--your-location js-your-location">
      مکان‌یابی خودکار
    </div>
  </div>
  <div class="c-remodal-location__content js-cities-container">
    <div class="c-general-location__row c-general-location__row--back js-back-to-states">
      بازگشت به لیست استان‌ها
    </div>
  </div>
</div>
<div class="remodal c-remodal-location c-remodal-location--addresses js-general-location-addresses" data-remodal-id="general-location" role="dialog" aria-labelledby="modal1Title" aria-describedby="modal1Desc">
  <div class="c-remodal-location__header">
    <span class="js-general-location-title">انتخاب آدرس</span>
    <div class="c-remodal-location__close js-close-modal"></div>
  </div>
  <div class="c-remodal-location__content js-addresses-container">
    <div class="c-ui-radio-wrapper c-ui-radio--general-location js-sample-address u-hidden">
      <label class="c-filter__label " for="generalLocationAddress"></label>
      <label class="c-ui-radio">
        <input type="radio" value="" name="generalLocationAddress" class="" id="generalLocationAddress" data-title="">
        <span class="c-ui-radio__check"></span>
      </label>
    </div>
    <a href="{{ route('front.addAddress') }}" class="c-general-location__add-address js-general-location-add-address">
      افزودن آدرس جدید
    </a>
  </div>
</div>
<div id="footer-data-ux"></div>

<footer class="c-footer-checkout">
  <div class="c-footer-checkout__content">
    <div class="c-footer-checkout__content-info">
      <div class="c-footer-checkout__content-info-container">
        <div class="c-footer-checkout__col">
          <div class="c-footer-checkout__col-phone">
            شماره تماس :
            <a href="tel: {{ $store_phone }}">
              {{ persianNum($store_phone) }}
            </a>
          </div>
        </div>
        <div class="c-footer-checkout__col">
          <div class="c-footer-checkout__col-email">
            آدرس ایمیل :
            <a href="mailto:{{ $store_email }}">
              {{ $store_email }}
            </a>
          </div>
        </div>
        <div class="c-footer-checkout__subtitle">
          استفاده از کد تخفیف، درصفحه ی پرداخت امکان پذیر است.
        </div>
        <div class="c-footer-checkout__copyright">
          Copyright © 2006 - 2021 DigiNova
        </div>
      </div>
    </div>
  </div>
</footer>

<script>
  // اضافه کردن توکن به درخواست های ایجکس
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  $(document).on('click', '.js-shipping-type-selector', function (){

    var weight_ids = $('input[class=js-shipping-type-selector]:checked').map(function(){return $(this).data('weight');}).get();
    var method_ids = $('input[class=js-shipping-type-selector]:checked').map(function(){return $(this).val();}).get();

    $.ajax({
      type: 'post',
      url: '{{ route('front.ajax.shippingCost') }}',
      data:{
        weight_ids: weight_ids,
        method_ids: method_ids,
      },
      success: function($respose) {
        $(".c-checkout-aside").replaceWith($respose.data.data)
      }
    });
  });


  $(document).on('click', '.js-save-shipping-data', function (){

    var weight_ids = $('input[class=js-shipping-type-selector]:checked').map(function(){return $(this).data('weight');}).get();
    var method_ids = $('input[class=js-shipping-type-selector]:checked').map(function(){return $(this).val();}).get();

    $.ajax({
      type: 'post',
      url: '{{ route('front.ajax.saveShippingToCookie') }}',
      data:{
        weight_ids: weight_ids,
        method_ids: method_ids,
      },
      success: function() {
        window.location.href= "{{ route('front.payment') }}";
      }
    });

  });



  {{--<input type="radio" value="{{ $method->id }}" class="js-shipping-type-selector" data-weight="{{ $weight->id }}" name="shipping-type-normal-0-0-{{ $i }}"--}}

</script>

</body>

</html>
