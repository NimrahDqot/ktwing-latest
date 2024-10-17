@extends('admin.app_admin')
@section('admin_content')
    <h1 class="h3 mb-3 text-gray-800">{{ EDIT_GENERAL_SETTING }}</h1>

    <form action="{{ route('admin_setting_general_update') }}" method="post" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="logo" value="{{ $setting->logo }}">
        <input type="hidden" name="favicon" value="{{ $setting->favicon }}">

        <div class="card shadow mb-4 t-left">
            <div class="card-body">
                <div class="row">
                    <div class="col-3">
                        <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                            <a class="nav-link active" id="p1_tab" data-toggle="pill" href="#p1" role="tab"
                                aria-controls="p1" aria-selected="true">{{ LOGO }}</a>
                            <a class="nav-link" id="p2_tab" data-toggle="pill" href="#p2" role="tab"
                                aria-controls="p2" aria-selected="false">{{ FAVICON }}</a>
                            <a class="nav-link" id="p11_tab" data-toggle="pill" href="#p11" role="tab"
                                aria-controls="p11" aria-selected="false">{{ TOP }}</a>
                            <a class="nav-link" id="p3_tab" data-toggle="pill" href="#p3" role="tab"
                                aria-controls="p3" aria-selected="false">{{ FOOTER }}</a>
                            <a class="nav-link" id="p15_tab" data-toggle="pill" href="#p15" role="tab"
                            aria-controls="p15" aria-selected="false">Setting</a>
                            <a class="nav-link" id="p16_tab" data-toggle="pill" href="#p16" role="tab"
                            aria-controls="p16" aria-selected="false">Social Link</a>
                            <a class="nav-link" id="p17_tab" data-toggle="pill" href="#p17" role="tab"
                            aria-controls="p17" aria-selected="false">SMS Gateway</a>

                            <a class="nav-link" id="p18_tab" data-toggle="pill" href="#p18" role="tab" aria-controls="p18" aria-selected="true">{{ PAYPAL }}</a>
                            <a class="nav-link" id="p19_tab" data-toggle="pill" href="#p19" role="tab" aria-controls="p19" aria-selected="false">{{ STRIPE }}</a>
                            <a class="nav-link" id="p20_tab" data-toggle="pill" href="#p20" role="tab" aria-controls="p20" aria-selected="false">{{ RAZORPAY }}</a>
                            <a class="nav-link" id="p21_tab" data-toggle="pill" href="#p21" role="tab" aria-controls="p21" aria-selected="false">{{ FLUTTERWAVE }}</a>
                            <a class="nav-link" id="p22_tab" data-toggle="pill" href="#p22" role="tab" aria-controls="p22" aria-selected="false">{{ MOLLIE }}</a>
                            <a class="nav-link" id="p23_tab" data-toggle="pill" href="#p23" role="tab" aria-controls="p23" aria-selected="false">S3 Bucket</a>

                        </div>
                    </div>
                    <div class="col-9">
                        <div class="tab-content" id="v-pills-tabContent">

                            <div class="tab-pane fade show active" id="p1" role="tabpanel" aria-labelledby="p1_tab">

                                <!-- Tab Content -->
                                <div class="form-group">
                                    <label for="">{{ EXISTING_LOGO }}</label>
                                    <div>
                                        @if (isset($setting->logo))
                                            <img src="{{ asset('uploads/site_photos/' . $setting->logo) }}" alt=""
                                                class="h_80">
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="">{{ CHANGE_LOGO }}</label>
                                    <div>
                                        <input type="file" name="logo">
                                    </div>
                                </div>
                                <!-- // Tab Content -->

                            </div>

                            <div class="tab-pane fade" id="p2" role="tabpanel" aria-labelledby="p2_tab">

                                <!-- Tab Content -->
                                <div class="form-group">
                                    <label for="">{{ EXISTING_FAVICON }}</label>
                                    <div>
                                        @if (isset($setting->favicon))
                                            <img src="{{ asset('uploads/site_photos/' . $setting->favicon) }}"
                                                alt="" class="h_80">
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="">{{ CHANGE_FAVICON }}</label>
                                    <div>
                                        <input type="file" name="favicon">
                                    </div>
                                </div>
                                <!-- // Tab Content -->

                            </div>

                            <div class="tab-pane fade" id="p11" role="tabpanel" aria-labelledby="p11_tab">

                                <!-- Tab Content -->
                                <div class="form-group">
                                    <label for="">{{ PHONE }}</label>
                                    <input type="number" name="top_phone" class="form-control"
                                        value="{{ $setting->top_phone }}">
                                </div>

                                <div class="form-group">
                                    <label for="">{{ EMAIL }}</label>
                                    <input type="email" name="top_email" class="form-control"
                                        value="{{ $setting->top_email }}">
                                </div>
                                <!-- // Tab Content -->

                            </div>

                            <div class="tab-pane fade" id="p3" role="tabpanel" aria-labelledby="p3_tab">

                                <div class="form-group">
                                    <label for="">{{ FOOTER_ADDRESS }}</label>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <input type="text" name="footer_address_1_heading" class="form-control"
                                                placeholder="Address:Head Office.."
                                                value="{{ $setting->footer_address_1_heading }}">
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" name="footer_address" class="form-control"
                                                placeholder="Address..." value="{{ $setting->footer_address }}">
                                        </div>
                                    </div>
                                    <div class="row mt-3 mb-3">
                                        <div class="col-md-6">
                                            <input type="text" name="footer_address_2_heading" class="form-control"
                                                placeholder="Address:Branch..."
                                                value="{{ $setting->footer_address_2_heading }}">
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" name="footer_another_address" class="form-control"
                                                placeholder="Address..." value="{{ $setting->footer_another_address }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="">{{ FOOTER_EMAIL }}</label>
                                    <textarea name="footer_email" class="form-control h_70" cols="30" rows="10">{{ $setting->footer_email }}</textarea>
                                </div>

                                <div class="form-group">
                                    <label for="">{{ FOOTER_PHONE }}</label>
                                    <div class="row mt-3 mb-3">
                                        <div class="col-md-6">
                                            <input type="text" name="footer_phone" class="form-control"
                                                placeholder="Phone Number" value="{{ $setting->footer_phone }}">
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" name="footer_other_phone" class="form-control"
                                                placeholder="Other Number" value="{{ $setting->footer_other_phone }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="">{{ FOOTER_COPYRIGHT }}</label>
                                    <textarea name="footer_copyright" class="form-control h_70" cols="30" rows="10">{{ $setting->footer_copyright }}</textarea>
                                </div>
                                <!-- // Tab Content -->

                            </div>



                            <div class="tab-pane fade" id="p15" role="tabpanel" aria-labelledby="p15_tab">

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="">App Name</label>
                                            <input type="text" name="app_name" class="form-control"
                                                placeholder="App Name.."
                                                value="{{ $setting->app_name }}">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="">Short Description</label>
                                            <textarea type="text" name="short_description" class="form-control"
                                                placeholder="Short Description..." value="">{{ $setting->short_description }}</textarea>
                                        </div>
                                    </div>
                                    <div class="row mt-3 mb-3">
                                        <div class="col-md-6">
                                            <label for="">Long Description</label>
                                            <textarea type="text" name="long_description" class="form-control"
                                            placeholder="Long Description..." value="">{{ $setting->long_description }}</textarea>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="">About us</label>
                                            <textarea type="text" name="about_us" class="form-control"
                                            placeholder="About us..." value="">{{ $setting->about_us }}</textarea>
                                        </div>
                                    </div>
                                </div>



                            </div>
                            <div class="tab-pane fade" id="p16" role="tabpanel" aria-labelledby="p16_tab">
                                <div id="social_item_wrapper">
                                    {{-- <div class="social_item">
                                        <div class="row">
                                            <div class="col-md-5">
                                                <div class="form-group">
                                                    <select name="social_icon[]" class="form-control">
                                                        <option value="Facebook">{{ FACEBOOK }}</option>
                                                        <option value="Twitter">{{ TWITTER }}</option>
                                                        <option value="LinkedIn">{{ LINKEDIN }}</option>
                                                        <option value="YouTube">{{ YOUTUBE }}</option>
                                                        <option value="Pinterest">{{ PINTEREST }}</option>
                                                        <option value="GooglePlus">{{ GOOGLE_PLUS }}</option>
                                                        <option value="Instagram">{{ INSTAGRAM }}</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="text" name="social_url[]" class="form-control" placeholder="URL">
                                                </div>
                                            </div>
                                            <div class="col-md-1">
                                                <div class="btn btn-success add_social_more"><i class="fas fa-plus"></i></div>
                                            </div>
                                        </div>
                                    </div> --}}
                                    <?php  $socialDetails = json_decode($setting->social_details, true); ?>
                                    @if($socialDetails)
                                        @foreach($socialDetails as $icon => $url)
                                            <div class="social_item">
                                                <div class="row">
                                                    <div class="col-md-5">
                                                        <div class="form-group">
                                                            <select name="social_icon[]" class="form-control">
                                                                <option value="Facebook" {{ $icon === 'Facebook' ? 'selected' : '' }}>FACEBOOK</option>
                                                                <option value="Twitter" {{ $icon === 'Twitter' ? 'selected' : '' }}>TWITTER</option>
                                                                <option value="LinkedIn" {{ $icon === 'LinkedIn' ? 'selected' : '' }}>LINKEDIN</option>
                                                                <option value="YouTube" {{ $icon === 'YouTube' ? 'selected' : '' }}>YOUTUBE</option>
                                                                <option value="Pinterest" {{ $icon === 'Pinterest' ? 'selected' : '' }}>PINTEREST</option>
                                                                <option value="GooglePlus" {{ $icon === 'GooglePlus' ? 'selected' : '' }}>GOOGLE PLUS</option>
                                                                <option value="Instagram" {{ $icon === 'Instagram' ? 'selected' : '' }}>INSTAGRAM</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <input type="text" name="social_url[]" class="form-control" placeholder="URL" value="{{ $url }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-1">
                                                        <div class="btn btn-danger remove_social"><i class="fas fa-trash-alt"></i></div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @else
                                        <div class="social_item">
                                            <div class="row">
                                                <div class="col-md-5">
                                                    <div class="form-group">
                                                        <select name="social_icon[]" class="form-control">
                                                            <option value="Facebook">FACEBOOK</option>
                                                            <option value="Twitter">TWITTER</option>
                                                            <option value="LinkedIn">LINKEDIN</option>
                                                            <option value="YouTube">YOUTUBE</option>
                                                            <option value="Pinterest">PINTEREST</option>
                                                            <option value="GooglePlus">GOOGLE PLUS</option>
                                                            <option value="Instagram">INSTAGRAM</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <input type="text" name="social_url[]" class="form-control" placeholder="URL">
                                                    </div>
                                                </div>
                                                <div class="col-md-1">
                                                    <div class="btn btn-success add_social_more"><i class="fas fa-plus"></i></div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                                <div class="btn btn-success add_social_more"><i class="fas fa-plus"></i></div>

                            </div>

                            <div class="tab-pane fade" id="p17" role="tabpanel" aria-labelledby="p17_tab">
                                <div class="form-group">
                                    <label for="">SMS_API_KEY</label>
                                    <input type="text" class="form-control" name="sms_api_key" value="{{ $setting->sms_api_key }}">
                                </div>
                                <div class="form-group">
                                    <label for="">SMS_API_SECRET</label>
                                    <input type="text" class="form-control" name="sms_api_secret" value="{{ $setting->sms_api_secret }}">
                                </div>
                                <div class="form-group">
                                    <label for="">SMS_SENDER_ID</label>
                                    <input type="text" class="form-control" name="sms_sender_id" value="{{ $setting->sms_sender_id }}">
                                </div>
                                <div class="form-group">
                                    <label for="">SMS_API_URL</label>
                                    <input type="text" class="form-control" name="sms_api_url" value="{{ $setting->sms_api_url }}">
                                </div>
                                <div class="form-group">
                                    <label for="">SMS_GATEWAY_USERNAME</label>
                                    <input type="text" class="form-control" name="sms_gateway_username" value="{{ $setting->sms_gateway_username }}">
                                </div>
                                <div class="form-group">
                                    <label for="">SMS_GATEWAY_PASSWORD</label>
                                    <input type="text" class="form-control" name="sms_gateway_password" value="{{ $setting->sms_gateway_password }}">
                                </div>
                                <div class="form-group">
                                    <label for="">{{ STATUS }}</label>
                                    <select name="sms_status" class="form-control">
                                        <option value="Show" @if($setting->sms_status == 'Show') selected @endif>{{ SHOW }}</option>
                                        <option value="Hide" @if($setting->sms_status == 'Hide') selected @endif>{{ HIDE }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="p18" role="tabpanel" aria-labelledby="p18_tab">
                                <div class="form-group">
                                    <label for="">{{ PAYPAL_ENVIRONMENT }}</label>
                                    <select name="paypal_environment" class="form-control">
                                        <option value="sandbox" @if($setting->paypal_environment == 'sandbox') selected @endif>{{ SANDBOX }}</option>
                                        <option value="production" @if($setting->paypal_environment == 'production') selected @endif>{{ PRODUCTION }}</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="">{{ PAYPAL_CLIENT_ID }}</label>
                                    <input type="text" class="form-control" name="paypal_client_id" value="{{ $setting->paypal_client_id }}">
                                </div>
                                <div class="form-group">
                                    <label for="">{{ PAYPAL_SECRET_KEY }}</label>
                                    <input type="text" class="form-control" name="paypal_secret_key" value="{{ $setting->paypal_secret_key }}">
                                </div>
                                <div class="form-group">
                                    <label for="">{{ STATUS }}</label>
                                    <select name="paypal_status" class="form-control">
                                        <option value="Show" @if($setting->paypal_status == 'Show') selected @endif>{{ SHOW }}</option>
                                        <option value="Hide" @if($setting->paypal_status == 'Hide') selected @endif>{{ HIDE }}</option>
                                    </select>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="p19" role="tabpanel" aria-labelledby="p19_tab">
                                <div class="form-group">
                                    <label for="">{{ STRIPE_PUBLIC_KEY }}</label>
                                    <input type="text" class="form-control" name="stripe_public_key" value="{{ $setting->stripe_public_key }}">
                                </div>
                                <div class="form-group">
                                    <label for="">{{ STRIPE_SECRET_KEY }}</label>
                                    <input type="text" class="form-control" name="stripe_secret_key" value="{{ $setting->stripe_secret_key }}">
                                </div>
                                <div class="form-group">
                                    <label for="">{{ STATUS }}</label>
                                    <select name="stripe_status" class="form-control">
                                        <option value="Show" @if($setting->stripe_status == 'Show') selected @endif>{{ SHOW }}</option>
                                        <option value="Hide" @if($setting->stripe_status == 'Hide') selected @endif>{{ HIDE }}</option>
                                    </select>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="p20" role="tabpanel" aria-labelledby="p20_tab">
                                <div class="form-group">
                                    <label for="">{{ RAZORPAY_KEY_ID }}</label>
                                    <input type="text" class="form-control" name="razorpay_key_id" value="{{ $setting->razorpay_key_id }}">
                                </div>
                                <div class="form-group">
                                    <label for="">{{ RAZORPAY_KEY_SECRET }}</label>
                                    <input type="text" class="form-control" name="razorpay_key_secret" value="{{ $setting->razorpay_key_secret }}">
                                </div>
                                <div class="form-group">
                                    <label for="">{{ STATUS }}</label>
                                    <select name="razorpay_status" class="form-control">
                                        <option value="Show" @if($setting->razorpay_status == 'Show') selected @endif>{{ SHOW }}</option>
                                        <option value="Hide" @if($setting->razorpay_status == 'Hide') selected @endif>{{ HIDE }}</option>
                                    </select>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="p21" role="tabpanel" aria-labelledby="p21_tab">
                                <div class="form-group">
                                    <label for="">{{ FLUTTERWAVE_COUNTRY }}</label>
                                    <input type="text" class="form-control" name="flutterwave_country" value="{{ $setting->flutterwave_country }}">
                                </div>
                                <div class="form-group">
                                    <label for="">{{ FLUTTERWAVE_PUBLIC_KEY }}</label>
                                    <input type="text" class="form-control" name="flutterwave_public_key" value="{{ $setting->flutterwave_public_key }}">
                                </div>
                                <div class="form-group">
                                    <label for="">{{ FLUTTERWAVE_SECRET_KEY }}</label>
                                    <input type="text" class="form-control" name="flutterwave_secret_key" value="{{ $setting->flutterwave_secret_key }}">
                                </div>
                                <div class="form-group">
                                    <label for="">{{ STATUS }}</label>
                                    <select name="flutterwave_status" class="form-control">
                                        <option value="Show" @if($setting->flutterwave_status == 'Show') selected @endif>{{ SHOW }}</option>
                                        <option value="Hide" @if($setting->flutterwave_status == 'Hide') selected @endif>{{ HIDE }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="p22" role="tabpanel" aria-labelledby="p22_tab">
                                <div class="form-group">
                                    <label for="">{{ MOLLIE_API_KEY }}</label>
                                    <input type="text" class="form-control" name="mollie_api_key" value="{{ $setting->mollie_api_key }}">
                                </div>
                                <div class="form-group">
                                    <label for="">{{ STATUS }}</label>
                                    <select name="mollie_status" class="form-control">
                                        <option value="Show" @if($setting->mollie_status == 'Show') selected @endif>{{ SHOW }}</option>
                                        <option value="Hide" @if($setting->mollie_status == 'Hide') selected @endif>{{ HIDE }}</option>
                                    </select>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="p23" role="tabpanel" aria-labelledby="p23_tab">
                                <div class="form-group">
                                    <label for="">AWS_ACCESS_KEY_ID</label>
                                    <input type="text" class="form-control" name="aws_key_id" value="{{ $setting->aws_key_id }}">
                                </div>
                                <div class="form-group">
                                    <label for="">AWS_SECRET_ACCESS_KEY</label>
                                    <input type="text" class="form-control" name="aws_secret_key" value="{{ $setting->aws_secret_key }}">
                                </div>
                                <div class="form-group">
                                    <label for="">AWS_DEFAULT_REGION</label>
                                    <input type="text" class="form-control" name="aws_default_region" value="{{ $setting->aws_default_region }}">
                                </div>
                                <div class="form-group">
                                    <label for="">AWS_BUCKET</label>
                                    <input type="text" class="form-control" name="aws_bucket" value="{{ $setting->aws_bucket }}">
                                </div>
                                <div class="form-group">
                                    <label for="">AWS_USE_PATH_STYLE_ENDPOINT</label>
                                    <input type="text" class="form-control" name="aws_use_path_style_endpint" value="{{ $setting->aws_use_path_style_endpint }}">
                                </div>
                                <div class="form-group">
                                    <label for="">{{ STATUS }}</label>
                                    <select name="aws_status" class="form-control">
                                        <option value="Show" @if($setting->aws_status == 'Show') selected @endif>{{ SHOW }}</option>
                                        <option value="Hide" @if($setting->aws_status == 'Hide') selected @endif>{{ HIDE }}</option>
                                    </select>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-success btn-block mb_50">{{ UPDATE }}</button>

    </form>

    <script>
$(document).ready(function() {
    // Add More Social Links
    $(document).on('click', '.add_social_more', function() {
        let socialRow = `
            <div class="social_item">
                <div class="row">
                    <div class="col-md-5">
                        <div class="form-group">
                            <select name="social_icon[]" class="form-control">
                                <option value="Facebook">{{ FACEBOOK }}</option>
                                <option value="Twitter">{{ TWITTER }}</option>
                                <option value="LinkedIn">{{ LINKEDIN }}</option>
                                <option value="YouTube">{{ YOUTUBE }}</option>
                                <option value="Pinterest">{{ PINTEREST }}</option>
                                <option value="GooglePlus">{{ GOOGLE_PLUS }}</option>
                                <option value="Instagram">{{ INSTAGRAM }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="text" name="social_url[]" class="form-control" placeholder="URL">
                        </div>
                    </div>
                    <div class="col-md-1">
                        <div class="btn btn-danger remove_social"><i class="fas fa-trash-alt"></i></div>
                    </div>
                </div>
            </div>`;

        $('#social_item_wrapper').append(socialRow);
    });

    // Remove Social Link
    $(document).on('click', '.remove_social', function() {
        $(this).closest('.social_item').remove();
    });

});

    </script>
@endsection
