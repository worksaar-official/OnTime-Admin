@extends('layouts.admin.app')

@section('title', translate('messages.app_settings'))

@push('css_or_js')
@endpush

@section('content')
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header d-flex flex-wrap align-items-center justify-content-between">
            <h1 class="page-header-title">
                <span class="page-header-icon">
                    <img src="{{ asset('public/assets/admin/img/setting.png') }}" class="w--26" alt="">
                </span>
                <span>
                    {{ translate('messages.app_settings') }}
                </span>
            </h1>
            {{-- <div class="text--primary-2 d-flex flex-wrap align-items-center" type="button" data-toggle="modal" data-target="#how-it-works">
                <strong class="mr-2">{{translate('See_how_it_works!')}}</strong>
                <div class="blinkings">
                    <i class="tio-info-outined"></i>
                </div>
            </div> --}}
        </div>
        <!-- End Page Header -->

        @php($app_minimum_version_android = \App\Models\BusinessSetting::where(['key' => 'app_minimum_version_android'])->first())
        @php($app_minimum_version_android = $app_minimum_version_android ? $app_minimum_version_android->value : null)

        @php($app_url_android = \App\Models\BusinessSetting::where(['key' => 'app_url_android'])->first())
        @php($app_url_android = $app_url_android ? $app_url_android->value : null)

        @php($app_minimum_version_ios = \App\Models\BusinessSetting::where(['key' => 'app_minimum_version_ios'])->first())
        @php($app_minimum_version_ios = $app_minimum_version_ios ? $app_minimum_version_ios->value : null)

        @php($app_url_ios = \App\Models\BusinessSetting::where(['key' => 'app_url_ios'])->first())
        @php($app_url_ios = $app_url_ios ? $app_url_ios->value : null)

        @php($app_minimum_version_android_store = \App\Models\BusinessSetting::where(['key' => 'app_minimum_version_android_store'])->first())
        @php($app_minimum_version_android_store = $app_minimum_version_android_store ? $app_minimum_version_android_store->value : null)
        @php($app_url_android_store = \App\Models\BusinessSetting::where(['key' => 'app_url_android_store'])->first())
        @php($app_url_android_store = $app_url_android_store ? $app_url_android_store->value : null)

        @php($app_minimum_version_ios_store = \App\Models\BusinessSetting::where(['key' => 'app_minimum_version_ios_store'])->first())
        @php($app_minimum_version_ios_store = $app_minimum_version_ios_store ? $app_minimum_version_ios_store->value : null)
        @php($app_url_ios_store = \App\Models\BusinessSetting::where(['key' => 'app_url_ios_store'])->first())
        @php($app_url_ios_store = $app_url_ios_store ? $app_url_ios_store->value : null)

        @php($app_minimum_version_android_deliveryman = \App\Models\BusinessSetting::where(['key' => 'app_minimum_version_android_deliveryman'])->first())
        @php($app_minimum_version_android_deliveryman = $app_minimum_version_android_deliveryman ? $app_minimum_version_android_deliveryman->value : null)
        @php($app_url_android_deliveryman = \App\Models\BusinessSetting::where(['key' => 'app_url_android_deliveryman'])->first())
        @php($app_url_android_deliveryman = $app_url_android_deliveryman ? $app_url_android_deliveryman->value : null)

        @php($app_minimum_version_ios_deliveryman = \App\Models\BusinessSetting::where(['key' => 'app_minimum_version_ios_deliveryman'])->first())
        @php($app_minimum_version_ios_deliveryman = $app_minimum_version_ios_deliveryman ? $app_minimum_version_ios_deliveryman->value : null)
        @php($app_url_ios_deliveryman = \App\Models\BusinessSetting::where(['key' => 'app_url_ios_deliveryman'])->first())
        @php($app_url_ios_deliveryman = $app_url_ios_deliveryman ? $app_url_ios_deliveryman->value : null)

        <form action="{{ route('admin.business-settings.app-settings') }}" method="post" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="type" value="user_app">
            <h5 class="card-title mb-3 pt-3">
                <span class="card-header-icon mr-2"><i class="tio-settings-outlined"></i></span>
                <span>{{ translate('User App Version Control') }}</span>
            </h5>
            <div class="card">
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <h5 class="card-title mb-3">
                                <img src="{{ asset('/public/assets/admin/img/andriod.png') }}" class="mr-2"
                                    alt="">
                                {{ translate('For android') }}
                            </h5>
                            <div class="__bg-F8F9FC-card">
                                <div class="form-group">
                                    <label for="app_minimum_version_android" class="form-label">
                                        {{ translate('Minimum_User_App_Version') }} ({{ translate('messages.android') }})
                                        <span class="input-label-secondary text--title" data-toggle="tooltip"
                                            data-placement="right"
                                            data-original-title="{{ translate('The_minimum_user_app_version_required_for_the_app_functionality.') }}">
                                            <i class="tio-info-outined"></i>
                                        </span>
                                    </label>
                                    <input id="app_minimum_version_android" type="text" inputmode="decimal"
                                        placeholder="{{ translate('messages.app_minimum_version') }}"
                                        class="form-control version-input" name="app_minimum_version_android"
                                        value="{{ env('APP_MODE') != 'demo' ? $app_minimum_version_android ?? '' : '' }}">
                                </div>
                                <div class="form-group mb-md-0">
                                    <label for="app_url_android" class="form-label">
                                        {{ translate('Download_URL_for_User_App') }} ({{ translate('messages.android') }})
                                        <span class="input-label-secondary text--title" data-toggle="tooltip"
                                            data-placement="right"
                                            data-original-title="{{ translate('Users_will_download_the_latest_user_app_version_using_this_URL.') }}">
                                            <i class="tio-info-outined"></i>
                                        </span>
                                    </label>
                                    <input id="app_url_android" type="text"
                                        placeholder="{{ translate('messages.app_url') }}" class="form-control"
                                        name="app_url_android"
                                        value="{{ env('APP_MODE') != 'demo' ? $app_url_android ?? '' : '' }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h5 class="card-title mb-3">
                                <img src="{{ asset('/public/assets/admin/img/ios.png') }}" class="mr-2" alt="">
                                {{ translate('For iOS') }}
                            </h5>
                            <div class="__bg-F8F9FC-card">
                                <div class="form-group">
                                    <label for="app_minimum_version_ios"
                                        class="form-label">{{ translate('Minimum_User_App_Version') }}
                                        ({{ translate('messages.ios') }})
                                        <span class="input-label-secondary text--title" data-toggle="tooltip"
                                            data-placement="right"
                                            data-original-title="{{ translate('The_minimum_user_app_version_required_for_the_app_functionality.') }}">
                                            <i class="tio-info-outined"></i>
                                        </span>
                                    </label>
                                    <input id="app_minimum_version_ios" type="text" inputmode="decimal"
                                        placeholder="{{ translate('messages.app_minimum_version') }}"
                                        class="form-control version-input" name="app_minimum_version_ios"
                                        value="{{ env('APP_MODE') != 'demo' ? $app_minimum_version_ios ?? '' : '' }}">
                                </div>
                                <div class="form-group mb-md-0">
                                    <label for="app_url_ios" class="form-label">
                                        {{ translate('Download_URL_for_User_App') }} ({{ translate('messages.ios') }})
                                        <span class="input-label-secondary text--title" data-toggle="tooltip"
                                            data-placement="right"
                                            data-original-title="{{ translate('Users_will_download_the_latest_user_app_version_using_this_URL.') }}">
                                            <i class="tio-info-outined"></i>
                                        </span>
                                    </label>
                                    <input id="app_url_ios" type="text"
                                        placeholder="{{ translate('messages.app_url') }}" class="form-control"
                                        name="app_url_ios"
                                        value="{{ env('APP_MODE') != 'demo' ? $app_url_ios ?? '' : '' }}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="btn--container justify-content-end mt-20">
                        <button type="reset" class="btn btn--reset">{{ translate('messages.reset') }}</button>
                        <button type="{{ env('APP_MODE') != 'demo' ? 'submit' : 'button' }}"
                            class="btn btn--primary call-demo">{{ translate('messages.submit') }}</button>
                    </div>
                </div>
            </div>
        </form>


        <form action="{{ route('admin.business-settings.app-settings') }}" method="post" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="type" value="store_app">
            <h5 class="card-title mb-3 pt-4">
                <span class="card-header-icon mr-2"><i class="tio-settings-outlined"></i></span>
                <span>{{ translate('Store_App_Version_Control') }}</span>
            </h5>
            <div class="card">
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <h5 class="card-title mb-3">
                                <img src="{{ asset('/public/assets/admin/img/andriod.png') }}" class="mr-2"
                                    alt="">
                                {{ translate('For android') }}
                            </h5>
                            <div class="__bg-F8F9FC-card">
                                <div class="form-group">
                                    <label for="app_minimum_version_android_store"
                                        class="form-label text-capitalize">{{ translate('Minimum_Store_App_Version_for_store') }}
                                        ({{ translate('messages.android') }})
                                        <span class="input-label-secondary text--title" data-toggle="tooltip"
                                            data-placement="right"
                                            data-original-title="{{ translate('The_minimum_store_app_version_required_for_the_app_functionality.') }}">
                                            <i class="tio-info-outined"></i>
                                        </span>
                                    </label>
                                    <input id="app_minimum_version_android_store" type="text" inputmode="decimal"
                                        placeholder="{{ translate('messages.app_minimum_version') }}"
                                        class="form-control h--45px version-input"
                                        name="app_minimum_version_android_store"
                                        value="{{ env('APP_MODE') != 'demo' ? $app_minimum_version_android_store ?? '' : '' }}">
                                </div>
                                <div class="form-group mb-md-0">
                                    <label for="app_url_android_store" class="form-label text-capitalize">
                                        {{ translate('Download_URL_for_Store_App_for_store') }}
                                        ({{ translate('messages.android') }})
                                        <span class="input-label-secondary text--title" data-toggle="tooltip"
                                            data-placement="right"
                                            data-original-title="{{ translate('Users_will_download_the_latest_store_app_using_this_URL.') }}">
                                            <i class="tio-info-outined"></i>
                                        </span>
                                    </label>
                                    <input id="app_url_android_store" type="text"
                                        placeholder="{{ translate('messages.Download_Url') }}"
                                        class="form-control h--45px" name="app_url_android_store"
                                        value="{{ env('APP_MODE') != 'demo' ? $app_url_android_store ?? '' : '' }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h5 class="card-title mb-3">
                                <img src="{{ asset('/public/assets/admin/img/ios.png') }}" class="mr-2"
                                    alt="">
                                {{ translate('For iOS') }}
                            </h5>
                            <div class="__bg-F8F9FC-card">
                                <div class="form-group">
                                    <label for="app_minimum_version_ios_store"
                                        class="form-label text-capitalize">{{ translate('Minimum_Store_App_Version') }}
                                        ({{ translate('messages.ios') }})
                                        <span class="input-label-secondary text--title" data-toggle="tooltip"
                                            data-placement="right"
                                            data-original-title="{{ translate('The_minimum_store_app_version_required_for_the_app_functionality.') }}">
                                            <i class="tio-info-outined"></i>
                                        </span>
                                    </label>
                                    <input id="app_minimum_version_ios_store" type="text" inputmode="decimal"
                                        placeholder="{{ translate('messages.app_minimum_version') }}"
                                        class="form-control h--45px version-input" name="app_minimum_version_ios_store"
                                        value="{{ env('APP_MODE') != 'demo' ? $app_minimum_version_ios_store ?? '' : '' }}">
                                </div>
                                <div class="form-group mb-md-0">
                                    <label for="app_url_ios_store" class="form-label text-capitalize">
                                        {{ translate('Download_URL_for_Store_App') }} ({{ translate('messages.ios') }})
                                        <span class="input-label-secondary text--title" data-toggle="tooltip"
                                            data-placement="right"
                                            data-original-title="{{ translate('Users_will_download_the_latest_store_app_version_using_this_URL.') }}">
                                            <i class="tio-info-outined"></i>
                                        </span>
                                    </label>
                                    <input id="app_url_ios_store" type="text"
                                        placeholder="{{ translate('messages.Download_Url') }}"
                                        class="form-control h--45px" name="app_url_ios_store"
                                        value="{{ env('APP_MODE') != 'demo' ? $app_url_ios_store ?? '' : '' }}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="btn--container justify-content-end mt-20">
                        <button type="reset" class="btn btn--reset">{{ translate('messages.reset') }}</button>
                        <button type="{{ env('APP_MODE') != 'demo' ? 'submit' : 'button' }}"
                            class="btn btn--primary call-demo">{{ translate('messages.submit') }}</button>
                    </div>
                </div>
            </div>
        </form>


        <form action="{{ route('admin.business-settings.app-settings') }}" method="post" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="type" value="deliveryman_app">
            <h5 class="card-title mb-3 pt-4">
                <span class="card-header-icon mr-2"><i class="tio-settings-outlined"></i></span>
                <span>{{ translate('Deliveryman_App_Version_Control') }}</span>
            </h5>
            <div class="card">
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <h5 class="card-title mb-3">
                                <img src="{{ asset('/public/assets/admin/img/andriod.png') }}" class="mr-2"
                                    alt="">
                                {{ translate('For android') }}
                            </h5>
                            <div class="__bg-F8F9FC-card">
                                <div class="form-group">
                                    <label for="app_minimum_version_android_deliveryman"
                                        class="form-label text-capitalize">{{ translate('Minimum_Deliveryman_App_Version') }}
                                        ({{ translate('messages.android') }})
                                        <span class="input-label-secondary text--title" data-toggle="tooltip"
                                            data-placement="right"
                                            data-original-title="{{ translate('The_minimum_deliveryman_app_version_required_for_the_app_functionality.') }}">
                                            <i class="tio-info-outined"></i>
                                        </span>
                                    </label>
                                    <input type="text" inputmode="decimal"
                                        id="app_minimum_version_android_deliveryman"
                                        placeholder="{{ translate('messages.app_minimum_version') }}"
                                        class="form-control h--45px version-input"
                                        name="app_minimum_version_android_deliveryman"
                                        value="{{ env('APP_MODE') != 'demo' ? $app_minimum_version_android_deliveryman ?? '' : '' }}">
                                </div>
                                <div class="form-group mb-md-0">
                                    <label for="app_url_android_deliveryman" class="form-label text-capitalize">
                                        {{ translate('Download_URL_for_Deliveryman_App') }}
                                        ({{ translate('messages.android') }})
                                        <span class="input-label-secondary text--title" data-toggle="tooltip"
                                            data-placement="right"
                                            data-original-title="{{ translate('Users_will_download_the_latest_deliveryman_app_version_using_this_URL.') }}">
                                            <i class="tio-info-outined"></i>
                                        </span>
                                    </label>
                                    <input type="text" id="app_url_android_deliveryman"
                                        placeholder="{{ translate('messages.Download_Url') }}"
                                        class="form-control h--45px" name="app_url_android_deliveryman"
                                        value="{{ env('APP_MODE') != 'demo' ? $app_url_android_deliveryman ?? '' : '' }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h5 class="card-title mb-3">
                                <img src="{{ asset('/public/assets/admin/img/ios.png') }}" class="mr-2"
                                    alt="">
                                {{ translate('For iOS') }}
                            </h5>
                            <div class="__bg-F8F9FC-card">
                                <div class="form-group">
                                    <label for="app_minimum_version_ios_deliveryman"
                                        class="form-label text-capitalize">{{ translate('Minimum_Deliveryman_App_Version') }}
                                        ({{ translate('messages.ios') }})
                                        <span class="input-label-secondary text--title" data-toggle="tooltip"
                                            data-placement="right"
                                            data-original-title="{{ translate('The_minimum_deliveryman_app_version_required_for_the_app_functionality.') }}">
                                            <i class="tio-info-outined"></i>
                                        </span>
                                    </label>
                                    <input id="app_minimum_version_ios_deliveryman" type="text" inputmode="decimal"
                                        placeholder="{{ translate('messages.app_minimum_version') }}"
                                        class="form-control h--45px version-input"
                                        name="app_minimum_version_ios_deliveryman"
                                        value="{{ env('APP_MODE') != 'demo' ? $app_minimum_version_ios_deliveryman ?? '' : '' }}">
                                </div>
                                <div class="form-group mb-md-0">
                                    <label for="app_url_ios_deliveryman" class="form-label text-capitalize">
                                        {{ translate('Download_URL_for_Deliveryman_App') }}
                                        ({{ translate('messages.ios') }})
                                        <span class="input-label-secondary text--title" data-toggle="tooltip"
                                            data-placement="right"
                                            data-original-title="{{ translate('Users_will_download_the_latest_deliveryman_app_version_using_this_URL.') }}">
                                            <i class="tio-info-outined"></i>
                                        </span>
                                    </label>
                                    <input id="app_url_ios_deliveryman" type="text"
                                        placeholder="{{ translate('messages.Download_Url') }}"
                                        class="form-control h--45px" name="app_url_ios_deliveryman"
                                        value="{{ env('APP_MODE') != 'demo' ? $app_url_ios_deliveryman ?? '' : '' }}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="btn--container justify-content-end mt-20">
                        <button type="reset" class="btn btn--reset">{{ translate('messages.reset') }}</button>
                        <button type="{{ env('APP_MODE') != 'demo' ? 'submit' : 'button' }}"
                            class="btn btn--primary call-demo">{{ translate('messages.submit') }}</button>
                    </div>
                </div>
            </div>
        </form>

    </div>


@endsection

@push('script_2')
    <script>
        $(document).on('ready', function() {
            // Strict numeric and dot validation
            $('.version-input').on('keypress', function(e) {
                // Allow only numbers and dot
                if ((e.which < 48 || e.which > 57) && e.which !== 46) {
                    e.preventDefault();
                }
            });

            $('.version-input').on('input', function() {
                // Remove any characters that aren't digits or dots
                this.value = this.value.replace(/[^0-9.]/g, '');

                // Ensure no more than 2 dots
                let dots = this.value.match(/\./g);
                if (dots && dots.length > 2) {
                    let parts = this.value.split('.');
                    this.value = parts[0] + '.' + parts[1] + '.' + parts[2];
                }
            });

            // Arrow key "Step" behavior
            $('.version-input').on('keydown', function(e) {
                if (e.which == 38 || e.which == 40) { // Up or Down arrows
                    e.preventDefault();
                    let val = $(this).val() || "1.0.0";
                    let parts = val.split('.');

                    // Pad with zeros if less than 3 parts (e.g. "3.7" becomes "3.7.0")
                    while (parts.length < 3) parts.push("0");

                    let lastIdx = parts.length - 1;
                    let lastPartValue = parseInt(parts[lastIdx]) || 0;

                    if (e.which == 38) { // Up
                        lastPartValue++;
                    } else if (e.which == 40) { // Down
                        if (lastPartValue > 0) lastPartValue--;
                    }

                    parts[lastIdx] = lastPartValue;
                    $(this).val(parts.join('.'));
                }
            });
        });
    </script>
@endpush
