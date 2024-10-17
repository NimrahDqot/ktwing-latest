<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GeneralSetting extends Model
{
    protected $fillable = [
    'logo', 'favicon', 'top_phone', 'top_email', 'footer_address', 'footer_email', 'footer_phone', 'footer_copyright',   'paypal_environment', 'paypal_client_id', 'paypal_secret_key', 'paypal_status', 'stripe_public_key', 'stripe_secret_key', 'stripe_status', 'razorpay_key_id', 'razorpay_key_secret', 'razorpay_status', 'flutterwave_country', 'flutterwave_public_key', 'flutterwave_secret_key', 'flutterwave_status', 'mollie_api_key', 'mollie_status', 'footer_address_1_heading', 'footer_address_2_heading', 'footer_another_address', 'footer_other_phone', 'app_name', 'short_description', 'long_description', 'about_us', 'social_details', 'sms_api_key', 'sms_api_secret', 'sms_sender_id', 'sms_api_url', 'sms_gateway_username', 'sms_gateway_password', 'sms_status', 'aws_key_id', 'aws_secret_key', 'aws_default_region', 'aws_bucket', 'aws_use_path_style_endpint', 'aws_status'     ];

}
