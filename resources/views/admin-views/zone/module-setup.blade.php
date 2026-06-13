@extends('layouts.admin.app')

@section('title', translate('Zone Wise Module Setup'))

@push('css_or_js')
@endpush

@section('content')

    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header">
            <h1 class="page-header-title mb-1">
                <span>
                    {{ translate('Connect_Module_With') }} {{ $zone->name }}
                </span>
            </h1>
            <p class="fs-14">
                {{ translate('Here_you_connect_your_modules_&_setup_the_delivery_charges_for_this_zone.') }}
            </p>
        </div>
        <!-- End Page Header -->
        <form action="{{ route('admin.business-settings.zone.module-update', $zone->id) }}" method="post" id="zone_form">
            @csrf

            <div class="col-md-12 mb-2">
                <div class="card">
                    <div class="card-body">

                        <div class="row g-3 align-items-end">

                            <div class="col-sm-5 col-md-4">
                                <h3 for="">{{ translate('Select Payment Method') }} </h3>
                                @if (data_get($cash_on_delivery, 'status') != 1 && data_get($digital_payment, 'status') != 1 && $offline_payment != 1)
                                    <div class="danger-notes-bg px-2 py-2 rounded fz-11  gap-2 align-items-center d-flex ">
                                        <img src="{{ asset('public/assets/admin/img/Icon.svg') }}" alt="">
                                        <img src="{{ asset('/public/assets/admin/svg/illustrations/sorry.svg') }}"
                                            alt="">
                                        <span>
                                            {{ translate('Must enable at least one payment method from your 3rd party payment settings.') }}
                                        </span>
                                    </div>
                                @else
                                    <div class="bg--4 px-2 py-2 rounded fz-11  gap-2 align-items-center d-flex ">
                                        <img src="{{ asset('public/assets/admin/img/Icon.svg') }}" alt="">

                                        <span>
                                            {{ translate('Must select at least one payment method.') }}
                                        </span>
                                    </div>
                                @endif
                            </div>
                            <div class="col-sm-7 col-md-8">
                                <div
                                    class="justify-content-around d-flex border h-auto flex-wrap form-control max-w-420 ml-auto">

                                    @if (data_get($cash_on_delivery, 'status') == 1)
                                        <div class="form-check form-check-inline mx-4  ">
                                            <input class="mx-2 form-check-input" type="checkbox"
                                                {{ $zone->cash_on_delivery == 1 ? 'checked' : '' }} id="cash_on_delivery"
                                                value="1" name="cash_on_delivery">
                                            <label class=" form-check-label"
                                                for="cash_on_delivery">{{ translate('Cash on Delivery') }}</label>
                                        </div>
                                    @endif
                                    @if (data_get($digital_payment, 'status') == 1)
                                        <div class="form-check form-check-inline mx-4  ">
                                            <input class="mx-2 form-check-input"
                                                {{ $zone->digital_payment == 1 ? 'checked' : '' }} type="checkbox"
                                                id="digital_payment" value="1" name="digital_payment">
                                            <label class=" form-check-label"
                                                for="digital_payment">{{ translate('Digital Payment') }}</label>
                                        </div>
                                    @endif
                                    @if ($offline_payment == 1)
                                        <div class="form-check form-check-inline mx-4  ">
                                            <input class="mx-2 form-check-input" type="checkbox"
                                                {{ $zone->offline_payment == 1 ? 'checked' : '' }} id="offline_payment"
                                                value="1" name="offline_payment">
                                            <label class=" form-check-label"
                                                for="offline_payment">{{ translate('Offline Payment') }}</label>
                                        </div>
                                    @endif

                                </div>


                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-12 mb-2">
                <div class="card">
                    <div class="card-body">
                        <div class="form-group mb-0">
                            <label class="input-label"
                                for="exampleFormControlSelect1">{{ translate('Choose_Business_Module_To_Connect') }}
                                <span class="input-label-secondary"></span></label>
                            <select name="module_id[]" id="choice_modules" required class="form-control js-select2-custom"
                                multiple="multiple">

                                @php($modules = \App\Models\Module::get(['id', 'module_name', 'module_type']))
                                @php($selected_modules = $zone->modules && count($zone->modules) > 0 ? $zone->modules->pluck('id')->toArray() : [])
                                @foreach ($modules as $module)
                                    <option value="{{ $module['id'] }}"
                                        {{ in_array($module['id'], $selected_modules) ? 'selected' : '' }}>
                                        {{ $module['module_name'] }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            @if (count($selected_modules) > 0)
                <div class="col-md-12 mb-2 mt-3">
                    <h4 class="m-0">{{ translate('Delivery_Charge_Setup') }}</h4>
                </div>
            @endif
            @if (count($modules) > 0)
                @foreach ($modules as $module)
                    @php($pivot = \App\Models\ModuleZone::where('zone_id', $zone->id)->where('module_id', $module->id)->first())
                    @if ($module->module_type == 'parcel')
                        <div class="col-md-12 mb-2" id="module_{{ $module->id }}">
                            <div class="module-row card view-details-container overflow-hidden">
                                <a href="#0"
                                    class="card-header border-0 view-btn d-flex align-items-center justify-content-between flex-wrap gap-1">
                                    <h5 class="m-0">{{ $module->module_name }} {{ translate('Module') }}</h5>
                                    <i class="tio-chevron-down fs-24 text-title"></i>
                                </a>
                                <div class="card-body view-details border-top">
                                    <div
                                        class="bg-opacity-primary-10 rounded py-2 px-3 d-flex flex-wrap gap-1 align-items-center">
                                        <div class="gap-1 d-flex align-items-center">
                                            <i class="tio-light-on theme-clr-dark fs-16"></i>
                                            <p class="m-0 fs-12">
                                                {{ translate('To Setup parcel module delivery charge please visit') }}
                                                <a href="#0"
                                                    class="font-semibold text-title">{{ translate('Parcel Module > Delivery Setup') }}</a>
                                                {{ translate('page.') }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" value="distance"
                            name="module_data[{{ $module->id }}][delivery_charge_type]">
                        <input type="hidden" name="module_data[{{ $module->id }}][fixed_shipping_charge]"
                            value="{{ $pivot?->fixed_shipping_charge ?? 0 }}">
                        <input type="hidden" name="module_data[{{ $module->id }}][per_km_shipping_charge]"
                            value="{{ $pivot?->per_km_shipping_charge ?? 0 }}">
                        <input type="hidden" name="module_data[{{ $module->id }}][minimum_shipping_charge]"
                            value="{{ $pivot?->minimum_shipping_charge ?? 0 }}">
                        <input type="hidden" name="module_data[{{ $module->id }}][maximum_shipping_charge]"
                            value="{{ $pivot?->maximum_shipping_charge ?? 0 }}">
                        <input type="hidden" name="module_data[{{ $module->id }}][maximum_cod_order_amount]"
                            value="{{ $pivot?->maximum_cod_order_amount ?? 0 }}">
                    @elseif ($module->module_type == 'rental' && addon_published_status('Rental'))
                        <div class="col-md-12 mb-2" id="module_{{ $module->id }}">
                            <div class="module-row card view-details-container overflow-hidden">
                                <a href="#0"
                                    class="card-header border-0 view-btn d-flex align-items-center justify-content-between flex-wrap gap-1">
                                    <h5 class="m-0">{{ $module->module_name }}</h5>
                                    <i class="tio-chevron-down fs-24 text-title"></i>
                                </a>
                                <div class="card-body view-details border-top">
                                    <div
                                        class="bg-opacity-primary-10 rounded py-2 px-3 d-flex flex-wrap gap-1 align-items-center">
                                        <div class="gap-1 d-flex align-items-center">
                                            <i class="tio-light-on theme-clr-dark fs-16"></i>
                                            <p class="m-0 fs-12">
                                                {{ translate('Rental module doesn’t support delivery charges. You can set trip fare per vehicle from:') }}
                                                <a href="#0"
                                                    class="font-semibold text-title">{{ translate('Rental Module > Vehicle Management > Vehicle Setup > List.') }}</a>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" value="distance"
                            name="module_data[{{ $module->id }}][delivery_charge_type]">
                        <input type="hidden" name="module_data[{{ $module->id }}][fixed_shipping_charge]"
                            value="{{ $pivot?->fixed_shipping_charge ?? 0 }}">
                        <input type="hidden" name="module_data[{{ $module->id }}][per_km_shipping_charge]"
                            value="{{ $pivot?->per_km_shipping_charge ?? 0 }}">
                        <input type="hidden" name="module_data[{{ $module->id }}][minimum_shipping_charge]"
                            value="{{ $pivot?->minimum_shipping_charge ?? 0 }}">
                        <input type="hidden" name="module_data[{{ $module->id }}][maximum_shipping_charge]"
                            value="{{ $pivot?->maximum_shipping_charge ?? 0 }}">
                        <input type="hidden" name="module_data[{{ $module->id }}][maximum_cod_order_amount]"
                            value="{{ $pivot?->maximum_cod_order_amount ?? 0 }}">
                    @else
                        <div class="col-md-12 mb-2" id="module_{{ $module->id }}">
                            <div class="module-row card view-details-container overflow-hidden">
                                <a href="#0"
                                    class="card-header border-0 view-btn d-flex align-items-center justify-content-between flex-wrap gap-1">
                                    <h5 class="m-0">{{ $module->module_name }} {{ translate('Module') }}</h5>
                                    <i class="tio-chevron-down fs-24 text-title"></i>
                                </a>
                                <div class="card-body view-details border-top">
                                    <div class="row gy-1">
                                        <div class="col-md-6 col-lg-4">
                                            <div class="form-group mb-0">
                                                <label
                                                    class="input-label text-capitalize fs-14 d-flex alig-items-center line--limit-1">
                                                    {{ translate('messages.Choose_Delivery_Charge_Type') }} <span
                                                        class="text-danger">*</span>
                                                </label>
                                                <div
                                                    class="d-flex align-items-center flex-wrap rounded py-2 px-2 border min-h-45px gap-2">
                                                    <label class="form-check form--check mr-2">
                                                        <input class="form-check-input delivery-type-radio" type="radio"
                                                            value="fixed"
                                                            name="module_data[{{ $module->id }}][delivery_charge_type]"
                                                            {{ $pivot?->delivery_charge_type == 'fixed' ? 'checked' : '' }}>
                                                        <span
                                                            class="form-check-label">{{ translate('messages.Fixed_Amount') }}</span>
                                                    </label>
                                                    <label class="form-check form--check mr-2">
                                                        <input class="form-check-input delivery-type-radio" type="radio"
                                                            value="distance"
                                                            name="module_data[{{ $module->id }}][delivery_charge_type]"
                                                            {{ $pivot?->delivery_charge_type != 'fixed' ? 'checked' : '' }}>
                                                        <span
                                                            class="form-check-label">{{ translate('messages.Distance_Wise') }}</span>
                                                    </label>
                                                    <label class="form-check form--check mr-0">
                                                        <input class="form-check-input delivery-type-radio" type="radio"
                                                            value="tier"
                                                            name="module_data[{{ $module->id }}][delivery_charge_type]"
                                                            {{ $pivot?->delivery_charge_type == 'tier' ? 'checked' : '' }}>
                                                        <span
                                                            class="form-check-label">{{ translate('messages.Tier_Wise') }}</span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-lg-4 tier-charge-field">
                                            <div class="form-group mb-0">
                                                <label
                                                    class="input-label text-capitalize fs-14 d-flex align-items-center line--limit-1">
                                                    {{ translate('messages.Tier_Wise_Status') }}
                                                </label>
                                                <div
                                                    class="d-flex align-items-center flex-wrap rounded py-2 px-2 border min-h-45px justify-content-center gap-2">
                                                    <span class="mr-2">{{ translate('messages.Range_Based') }}</span>
                                                    <label class="toggle-switch toggle-switch-sm">
                                                        <input type="checkbox" class="toggle-switch-input"
                                                            name="module_data[{{ $module->id }}][tier_wise_delivery_charge]"
                                                            value="1"
                                                            {{ $pivot?->tier_wise_delivery_charge ? 'checked' : '' }}>
                                                        <span class="toggle-switch-label">
                                                            <span class="toggle-switch-indicator"></span>
                                                        </span>
                                                    </label>
                                                    <span class="ml-2">{{ translate('messages.Tier_Based') }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-lg-4 fixed-charge-field">
                                            <div class="form-group mb-0">
                                                <label
                                                    class="input-label text-capitalize fs-14 d-flex alig-items-center line--limit-1">
                                                    {{ translate('messages.Amount') }}
                                                    ({{ \App\CentralLogics\Helpers::currency_symbol() }})
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <input type="number" class="form-control"
                                                    name="module_data[{{ $module->id }}][fixed_shipping_charge]"
                                                    step=".01" min="0"
                                                    placeholder="{{ translate('messages.Ex:10') }}"
                                                    value="{{ $pivot?->fixed_shipping_charge }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-lg-4 distance-charge-field tier-charge-field">
                                            <div class="form-group mb-0">
                                                <label
                                                    class="input-label text-capitalize fs-14 d-flex alig-items-center line--limit-1">
                                                    {{ translate('messages.Per_km_delivery_charge') }}
                                                    ({{ \App\CentralLogics\Helpers::currency_symbol() }}) <span
                                                        class="text-danger">*</span>
                                                </label>
                                                <input type="number" class="form-control"
                                                    name="module_data[{{ $module->id }}][per_km_shipping_charge]"
                                                    step=".01" min="0"
                                                    placeholder="{{ translate('messages.Ex:10') }}"
                                                    value="{{ $pivot?->per_km_shipping_charge }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-lg-4 distance-charge-field tier-charge-field">
                                            <div class="form-group mb-0">
                                                <label
                                                    class="input-label text-capitalize fs-14 d-flex alig-items-center line--limit-1">
                                                    {{ translate('messages.Maximum_delivery_charge') }}
                                                    ({{ \App\CentralLogics\Helpers::currency_symbol() }})
                                                </label>
                                                <input type="number" step=".01" min="0" class="form-control"
                                                    name="module_data[{{ $module->id }}][maximum_shipping_charge]"
                                                    placeholder="{{ translate('messages.Ex:10') }}"
                                                    value="{{ $pivot?->maximum_shipping_charge }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-lg-4 distance-charge-field">
                                            <div class="form-group mb-0">
                                                <label
                                                    class="input-label text-capitalize fs-14 d-flex alig-items-center line--limit-1">
                                                    {{ translate('messages.Minimum_delivery_charge') }}
                                                    ({{ \App\CentralLogics\Helpers::currency_symbol() }}) <span
                                                        class="text-danger">*</span>
                                                </label>
                                                <input type="number" step=".01" min="0" class="form-control"
                                                    name="module_data[{{ $module->id }}][minimum_shipping_charge]"
                                                    placeholder="{{ translate('messages.Ex:10') }}"
                                                    value="{{ $pivot?->minimum_shipping_charge }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-lg-4 distance-charge-field tier-charge-field">
                                            <div class="form-group mb-0">
                                                <label
                                                    class="input-label text-capitalize fs-14 d-flex alig-items-center line--limit-1">
                                                    {{ translate('messages.Maximum_cod_order_amount') }}
                                                    ({{ \App\CentralLogics\Helpers::currency_symbol() }})
                                                </label>
                                                <input type="number" step=".01" min="0" class="form-control"
                                                    name="module_data[{{ $module->id }}][maximum_cod_order_amount]"
                                                    placeholder="{{ translate('messages.Ex:10') }}"
                                                    value="{{ $pivot?->maximum_cod_order_amount }}">
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-lg-4 distance-charge-field tier-charge-field">
                                            <div class="form-group mb-0">
                                                <label
                                                    class="input-label text-capitalize fs-14 d-flex align-items-center line--limit-1">
                                                    {{ translate('messages.Extra_Vehicle_Charge') }}
                                                </label>
                                                <div
                                                    class="d-flex align-items-center flex-wrap rounded py-2 px-2 border min-h-45px justify-content-center gap-2">
                                                    <label class="toggle-switch toggle-switch-sm">
                                                        <input type="checkbox" class="toggle-switch-input"
                                                            name="module_data[{{ $module->id }}][extra_vehicle_charge_toggle]"
                                                            value="1"
                                                            {{ $pivot?->extra_vehicle_charge_toggle ? 'checked' : '' }}>
                                                        <span class="toggle-switch-label">
                                                            <span class="toggle-switch-indicator"></span>
                                                        </span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12 tier-charge-field">
                                            <div class="mt-4">
                                                <div class="d-flex justify-content-between align-items-center mb-3">
                                                    <h5 class="m-0">{{ translate('messages.Distance_Wise_Tiers') }}
                                                    </h5>
                                                    <button type="button" class="btn btn--primary add-tier-btn"
                                                        data-module-id="{{ $module->id }}"><i class="tio-add"></i>
                                                        {{ translate('messages.Add_Tier') }}</button>
                                                </div>
                                                @php($tiers = $pivot?->tiered_delivery_charge ?? [])
                                                <div class="table-responsive {{ is_array($tiers) && count($tiers) > 0 ? '' : 'd-none' }}"
                                                    id="tier-table-{{ $module->id }}">
                                                    <table class="table table-bordered">
                                                        <thead class="thead-light">
                                                            <tr>
                                                                <th>{{ translate('messages.Start_distance') }}</th>
                                                                <th>{{ translate('messages.End_distance') }}</th>
                                                                <th>{{ translate('messages.Charges') }}</th>
                                                                <th class="text-center">
                                                                    {{ translate('messages.Action') }}</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody id="tier-body-{{ $module->id }}">
                                                            @foreach ($tiers as $index => $tier)
                                                                <tr>
                                                                    <td><input type="number" step=".01"
                                                                            name="module_data[{{ $module->id }}][tiered_delivery_charge][{{ $index }}][start]"
                                                                            value="{{ $tier['start'] }}"
                                                                            class="form-control"
                                                                            placeholder="{{ translate('messages.Ex:0') }}">
                                                                    </td>
                                                                    <td><input type="number" step=".01"
                                                                            name="module_data[{{ $module->id }}][tiered_delivery_charge][{{ $index }}][end]"
                                                                            value="{{ $tier['end'] }}"
                                                                            class="form-control"
                                                                            placeholder="{{ translate('messages.Ex:5') }}">
                                                                    </td>
                                                                    <td><input type="number" step=".01"
                                                                            name="module_data[{{ $module->id }}][tiered_delivery_charge][{{ $index }}][charge]"
                                                                            value="{{ $tier['charge'] }}"
                                                                            class="form-control"
                                                                            placeholder="{{ translate('messages.Ex:10') }}">
                                                                    </td>
                                                                    <td class="text-center"><button type="button"
                                                                            class="btn btn-outline-danger btn-sm delete-tier-row"
                                                                            data-module-id="{{ $module->id }}"><i
                                                                                class="tio-delete"></i></button></td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            @endif

            <div class="col-md-12">
                <div class="btn--container mt-3 justify-content-end">
                    <button id="reset_btn" type="reset"
                        class="btn btn--reset">{{ translate('messages.Reset') }}</button>
                    <button type="submit"
                        class="btn btn--primary">{{ translate('messages.Save Information') }}</button>
                </div>
            </div>
        </form>
    </div>

@endsection

@push('script_2')
    <script src="{{ asset('public/assets/admin') }}/js/tags-input.min.js"></script>
    <script>
        "use strict";

        $(document).ready(function() {
            function toggleModuleSections() {
                let selectedModules = $('#choice_modules').val() || [];

                $('[id^="module_"]').addClass('d-none');

                selectedModules.forEach(function(moduleId) {
                    $('#module_' + moduleId).removeClass('d-none');
                });
            }

            toggleModuleSections();

            $('#choice_modules').on('change', function() {
                toggleModuleSections();
            });

            function toggleChargeFields(moduleContainer) {
                const selectedType = moduleContainer.find('input.delivery-type-radio:checked').val();

                moduleContainer.find('.fixed-charge-field').addClass('d-none');
                moduleContainer.find('.distance-charge-field').addClass('d-none');
                moduleContainer.find('.tier-charge-field').addClass('d-none');

                if (selectedType === 'fixed') {
                    moduleContainer.find('.fixed-charge-field').removeClass('d-none');
                } else if (selectedType === 'tier') {
                    moduleContainer.find('.tier-charge-field').removeClass('d-none');
                } else {
                    moduleContainer.find('.distance-charge-field').removeClass('d-none');
                }
            }

            $('[id^="module_"]').each(function() {
                const moduleContainer = $(this);

                toggleChargeFields(moduleContainer);

                moduleContainer.find('input.delivery-type-radio').on('change', function() {
                    toggleChargeFields(moduleContainer);
                });
            });

            $(document).on('click', '.add-tier-btn', function() {
                const moduleId = $(this).data('module-id');
                const tierBody = $('#tier-body-' + moduleId);
                const tierTable = $('#tier-table-' + moduleId);
                const index = tierBody.find('tr').length;
                const row = `
                    <tr>
                        <td><input type="number" step=".01" name="module_data[${moduleId}][tiered_delivery_charge][${index}][start]" class="form-control" placeholder="{{ translate('messages.Ex:0') }}"></td>
                        <td><input type="number" step=".01" name="module_data[${moduleId}][tiered_delivery_charge][${index}][end]" class="form-control" placeholder="{{ translate('messages.Ex:5') }}"></td>
                        <td><input type="number" step=".01" name="module_data[${moduleId}][tiered_delivery_charge][${index}][charge]" class="form-control" placeholder="{{ translate('messages.Ex:10') }}"></td>
                        <td class="text-center"><button type="button" class="btn btn-outline-danger btn-sm delete-tier-row" data-module-id="${moduleId}"><i class="tio-delete"></i></button></td>
                    </tr>
                `;
                tierBody.append(row);
                tierTable.removeClass('d-none');
            });

            $(document).on('click', '.delete-tier-row', function() {
                const moduleId = $(this).data('module-id');
                const tierBody = $('#tier-body-' + moduleId);
                const tierTable = $('#tier-table-' + moduleId);
                $(this).closest('tr').remove();
                if (tierBody.find('tr').length === 0) {
                    tierTable.addClass('d-none');
                }
            });
        });
    </script>
@endpush
