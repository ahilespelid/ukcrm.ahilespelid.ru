@extends('admin.index')

@section('content')
@php
    $page_title = 'Роли пользователей';
@endphp
<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
<!--begin::Toolbar-->
<div class="toolbar" id="kt_toolbar">
    <!--begin::Container-->
    <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
        <!--begin::Page title-->
        <div data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}" class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
            <!--begin::Title-->
            <h1 class="d-flex text-dark fw-bolder fs-3 align-items-center my-1">{{ $page_title }}</h1>
            <!--end::Title-->
            <!--begin::Separator-->
            <span class="h-20px border-gray-300 border-start mx-4"></span>
            <!--end::Separator-->
            <!--begin::Breadcrumb-->
                <x-breadcrumb :items="[
                        0 => ['name' => 'Главная', 'link' => 'admin'],
                    ]"/>
            <!--end::Breadcrumb-->
        </div>
        <!--end::Page title-->
    </div>
    <!--end::Container-->
</div>
<!--end::Toolbar-->
<!--begin::Post-->
<div class="post d-flex flex-column-fluid" id="kt_post">
    <!--begin::Container-->
    <div id="kt_content_container" class="container-xxl">
        <!--begin::Row-->
        <div class="row row-cols-1 row-cols-md-2 row-cols-xl-3 g-5 g-xl-9">
            @foreach ($data['roles'] as $role)
            <!--begin::Col-->
            <div class="col-md-4">
                <!--begin::Card-->
                <div class="card card-flush h-md-100">
                    <!--begin::Card header-->
                    <div class="card-header">
                        <!--begin::Card title-->
                        <div class="card-title">
                            <h2>{{ $role->name }}</h2>
                        </div>
                        <!--end::Card title-->
                    </div>
                    <!--end::Card header-->
                    <!--begin::Card body-->
                    <div class="card-body pt-1">
                        @php
                            foreach ($role->users as $value) {
                                $countUsers[] = $value->name;
                            }
                            $role->users['coun_users'] = count($countUsers);
                            unset($countUsers);
                        @endphp
                        <!--begin::Users-->
                        <div class="fw-bolder text-gray-600 mb-5">Пользователей: {{ $role->users['coun_users'] }}</div>
                        <!--end::Users-->
                        <!--begin::Permissions-->
                        <div class="d-flex flex-column text-gray-600">
                            @foreach ($data['permissions'] as $perm)
                            <div class="d-flex align-items-center py-2">
                                <span class="bullet bg-primary me-3"></span>{{ $perm->name }}
                            </div>
                            @endforeach
                        </div>
                        <!--end::Permissions-->
                    </div>
                    <!--end::Card body-->
                    <!--begin::Card footer-->
                    <div class="card-footer flex-wrap pt-0">
                        <a href="/" class="btn btn-light btn-active-primary my-1 me-2">Просмотреть</a>
                        <button type="button" class="btn btn-light btn-active-light-primary my-1" data-bs-toggle="modal" data-bs-target="#kt_modal_update_role">Изменить</button>
                    </div>
                    <!--end::Card footer-->
                </div>
                <!--end::Card-->
            </div>
            <!--end::Col-->
            @endforeach

            <!--begin::Add new card-->
            <div class="ol-md-4">
                <!--begin::Card-->
                <div class="card h-md-100">
                    <!--begin::Card body-->
                    <div class="card-body d-flex flex-center">
                        <!--begin::Button-->
                        <button type="button" class="btn btn-clear d-flex flex-column flex-center" data-bs-toggle="modal" data-bs-target="#kt_modal_add_role">
                            <!--begin::Illustration-->
                            <img src="assets/media/illustrations/sketchy-1/4.png" alt="" class="mw-100 mh-150px mb-7" />
                            <!--end::Illustration-->
                            <!--begin::Label-->
                            <div class="fw-bolder fs-3 text-gray-600 text-hover-primary">Добавить новую роль</div>
                            <!--end::Label-->
                        </button>
                        <!--begin::Button-->
                    </div>
                    <!--begin::Card body-->
                </div>
                <!--begin::Card-->
            </div>
            <!--begin::Add new card-->
        </div>
        <!--end::Row-->

        <!--begin::Modals-->
        <!--begin::Modal - Add role-->
        <div class="modal fade" id="kt_modal_add_role" tabindex="-1" aria-hidden="true">
            <!--begin::Modal dialog-->
            <div class="modal-dialog modal-dialog-centered mw-750px">
                <!--begin::Modal content-->
                <div class="modal-content">
                    <!--begin::Modal header-->
                    <div class="modal-header">
                        <!--begin::Modal title-->
                        <h2 class="fw-bolder">Новая роль</h2>
                        <!--end::Modal title-->
                        <!--begin::Close-->
                        <div class="btn btn-icon btn-sm btn-active-icon-primary" data-kt-roles-modal-action="close">
                            <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                            <span class="svg-icon svg-icon-1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="currentColor" />
                                    <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="currentColor" />
                                </svg>
                            </span>
                            <!--end::Svg Icon-->
                        </div>
                        <!--end::Close-->
                    </div>
                    <!--end::Modal header-->
                    <!--begin::Modal body-->
                    <div class="modal-body scroll-y mx-lg-5 my-7">
                        <!--begin::Form-->
                        <form id="kt_modal_add_role_form" class="form" action="#">
                            <!--begin::Scroll-->
                            <div class="d-flex flex-column scroll-y me-n7 pe-7" id="kt_modal_add_role_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_role_header" data-kt-scroll-wrappers="#kt_modal_add_role_scroll" data-kt-scroll-offset="300px">
                                <!--begin::Input group-->
                                <div class="fv-row mb-10">
                                    <!--begin::Label-->
                                    <label class="fs-5 fw-bolder form-label mb-2">
                                        <span class="required">Название</span>
                                    </label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <input class="form-control form-control-solid" placeholder="Введите название новой роли" name="role_name" />
                                    <!--end::Input-->
                                </div>
                                <!--end::Input group-->
                                <!--begin::Permissions-->
                                <div class="fv-row">
                                    <!--begin::Label-->
                                    <label class="fs-5 fw-bolder form-label mb-2">Права</label>
                                    <!--end::Label-->
                                    <!--begin::Table wrapper-->
                                    <div class="table-responsive">
                                        <!--begin::Table-->
                                        <table class="table align-middle table-row-dashed fs-6 gy-5">
                                            <!--begin::Table body-->
                                            <tbody class="text-gray-600 fw-bold">
                                                <!--begin::Table row-->
                                                <tr>
                                                    <td class="text-gray-800">Полный доступ
                                                    <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="Это права администратора, предоставляют полный доступ к системе"></i></td>
                                                    <td>
                                                        <!--begin::Checkbox-->
                                                        <label class="form-check form-check-custom form-check-solid me-9">
                                                            <input class="form-check-input" type="checkbox" value="" id="kt_roles_select_all" />
                                                            <span class="form-check-label" for="kt_roles_select_all">выбрать все</span>
                                                        </label>
                                                        <!--end::Checkbox-->
                                                    </td>
                                                </tr>
                                                <!--end::Table row-->
                                                <!--begin::Table row-->
                                                <tr>
                                                    <!--begin::Label-->
                                                    <td class="text-gray-800">Управление пользователями</td>
                                                    <!--end::Label-->
                                                    <!--begin::Options-->
                                                    <td>
                                                        <!--begin::Wrapper-->
                                                        <div class="d-flex">
                                                            <!--begin::Checkbox-->
                                                            <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                                <input class="form-check-input" type="checkbox" value="" name="user_management_read" />
                                                                <span class="form-check-label">Просмотр</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                            <!--begin::Checkbox-->
                                                            <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                                <input class="form-check-input" type="checkbox" value="" name="user_management_write" />
                                                                <span class="form-check-label">Изменение</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                            <!--begin::Checkbox-->
                                                            <label class="form-check form-check-sm form-check-custom form-check-solid">
                                                                <input class="form-check-input" type="checkbox" value="" name="user_management_create" />
                                                                <span class="form-check-label">Создание</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                        </div>
                                                        <!--end::Wrapper-->
                                                    </td>
                                                    <!--end::Options-->
                                                </tr>
                                                <!--end::Table row-->
                                                <!--begin::Table row-->
                                                <tr>
                                                    <!--begin::Label-->
                                                    <td class="text-gray-800">Импорт документов</td>
                                                    <!--end::Label-->
                                                    <!--begin::Options-->
                                                    <td>
                                                        <!--begin::Wrapper-->
                                                        <div class="d-flex">
                                                            <!--begin::Checkbox-->
                                                            <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                                <input class="form-check-input" type="checkbox" value="" name="content_management_read" />
                                                                <span class="form-check-label">Просмотр</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                            <!--begin::Checkbox-->
                                                            <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                                <input class="form-check-input" type="checkbox" value="" name="content_management_write" />
                                                                <span class="form-check-label">Изменение</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                            <!--begin::Checkbox-->
                                                            <label class="form-check form-check-sm form-check-custom form-check-solid">
                                                                <input class="form-check-input" type="checkbox" value="" name="content_management_create" />
                                                                <span class="form-check-label">Создание</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                        </div>
                                                        <!--end::Wrapper-->
                                                    </td>
                                                    <!--end::Options-->
                                                </tr>
                                                <!--end::Table row-->
                                                <!--begin::Table row-->
                                                <tr>
                                                    <!--begin::Label-->
                                                    <td class="text-gray-800">Экспорт документов</td>
                                                    <!--end::Label-->
                                                    <!--begin::Options-->
                                                    <td>
                                                        <!--begin::Wrapper-->
                                                        <div class="d-flex">
                                                            <!--begin::Checkbox-->
                                                            <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                                <input class="form-check-input" type="checkbox" value="" name="financial_management_read" />
                                                                <span class="form-check-label">Просмотр</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                            <!--begin::Checkbox-->
                                                            <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                                <input class="form-check-input" type="checkbox" value="" name="financial_management_write" />
                                                                <span class="form-check-label">Изменение</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                            <!--begin::Checkbox-->
                                                            <label class="form-check form-check-sm form-check-custom form-check-solid">
                                                                <input class="form-check-input" type="checkbox" value="" name="financial_management_create" />
                                                                <span class="form-check-label">Создание</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                        </div>
                                                        <!--end::Wrapper-->
                                                    </td>
                                                    <!--end::Options-->
                                                </tr>
                                                <!--end::Table row-->
                                            </tbody>
                                            <!--end::Table body-->
                                        </table>
                                        <!--end::Table-->
                                    </div>
                                    <!--end::Table wrapper-->
                                </div>
                                <!--end::Permissions-->
                            </div>
                            <!--end::Scroll-->
                            <!--begin::Actions-->
                            <div class="text-center pt-15">
                                <button type="reset" class="btn btn-light me-3" data-kt-roles-modal-action="cancel">Отменить</button>
                                <button type="submit" class="btn btn-primary" data-kt-roles-modal-action="submit">
                                    <span class="indicator-label">Добавить</span>
                                    <span class="indicator-progress">Пожалуйста подождите...
                                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                </button>
                            </div>
                            <!--end::Actions-->
                        </form>
                        <!--end::Form-->
                    </div>
                    <!--end::Modal body-->
                </div>
                <!--end::Modal content-->
            </div>
            <!--end::Modal dialog-->
        </div>
        <!--end::Modal - Add role-->
        <!--begin::Modal - Update role-->
        <div class="modal fade" id="kt_modal_update_role" tabindex="-1" aria-hidden="true">
            <!--begin::Modal dialog-->
            <div class="modal-dialog modal-dialog-centered mw-750px">
                <!--begin::Modal content-->
                <div class="modal-content">
                    <!--begin::Modal header-->
                    <div class="modal-header">
                        <!--begin::Modal title-->
                        <h2 class="fw-bolder">Изменить роль</h2>
                        <!--end::Modal title-->
                        <!--begin::Close-->
                        <div class="btn btn-icon btn-sm btn-active-icon-primary" data-kt-roles-modal-action="close">
                            <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                            <span class="svg-icon svg-icon-1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="currentColor" />
                                    <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="currentColor" />
                                </svg>
                            </span>
                            <!--end::Svg Icon-->
                        </div>
                        <!--end::Close-->
                    </div>
                    <!--end::Modal header-->
                    <!--begin::Modal body-->
                    <div class="modal-body scroll-y mx-5 my-7">
                        <!--begin::Form-->
                        <form id="kt_modal_update_role_form" class="form" action="#">
                            <!--begin::Scroll-->
                            <div class="d-flex flex-column scroll-y me-n7 pe-7" id="kt_modal_update_role_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_update_role_header" data-kt-scroll-wrappers="#kt_modal_update_role_scroll" data-kt-scroll-offset="300px">
                                <!--begin::Input group-->
                                <div class="fv-row mb-10">
                                    <!--begin::Label-->
                                    <label class="fs-5 fw-bolder form-label mb-2">
                                        <span class="required">Название роли</span>
                                    </label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <input class="form-control form-control-solid" placeholder="Enter a role name" name="role_name" value="role['name']" />
                                    <!--end::Input-->
                                </div>
                                <!--end::Input group-->
                                <!--begin::Permissions-->
                                <div class="fv-row">
                                    <!--begin::Label-->
                                    <label class="fs-5 fw-bolder form-label mb-2">Права</label>
                                    <!--end::Label-->
                                    <!--begin::Table wrapper-->
                                    <div class="table-responsive">
                                        <!--begin::Table-->
                                        <table class="table align-middle table-row-dashed fs-6 gy-5">
                                            <!--begin::Table body-->
                                            <tbody class="text-gray-600 fw-bold">
                                                <!--begin::Table row-->
                                                <tr>
                                                    <td class="text-gray-800">Полный доступ
                                                    <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="Это права администратора, предоставляют полный доступ к системе"></i></td>
                                                    <td>
                                                        <!--begin::Checkbox-->
                                                        <label class="form-check form-check-custom form-check-solid me-9">
                                                            <input class="form-check-input" type="checkbox" value="" id="kt_roles_select_all" />
                                                            <span class="form-check-label" for="kt_roles_select_all">выбрать все</span>
                                                        </label>
                                                        <!--end::Checkbox-->
                                                    </td>
                                                </tr>
                                                <!--end::Table row-->
                                                <!--begin::Table row-->
                                                <tr>
                                                    <!--begin::Label-->
                                                    <td class="text-gray-800">Управление пользователями</td>
                                                    <!--end::Label-->
                                                    <!--begin::Options-->
                                                    <td>
                                                        <!--begin::Wrapper-->
                                                        <div class="d-flex">
                                                            <!--begin::Checkbox-->
                                                            <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                                <input class="form-check-input" type="checkbox" value="" name="user_management_read" />
                                                                <span class="form-check-label">Просмотр</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                            <!--begin::Checkbox-->
                                                            <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                                <input class="form-check-input" type="checkbox" value="" name="user_management_write" />
                                                                <span class="form-check-label">Изменение</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                            <!--begin::Checkbox-->
                                                            <label class="form-check form-check-sm form-check-custom form-check-solid">
                                                                <input class="form-check-input" type="checkbox" value="" name="user_management_create" />
                                                                <span class="form-check-label">Создание</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                        </div>
                                                        <!--end::Wrapper-->
                                                    </td>
                                                    <!--end::Options-->
                                                </tr>
                                                <!--end::Table row-->
                                                <!--begin::Table row-->
                                                <tr>
                                                    <!--begin::Label-->
                                                    <td class="text-gray-800">Импорт документов</td>
                                                    <!--end::Label-->
                                                    <!--begin::Options-->
                                                    <td>
                                                        <!--begin::Wrapper-->
                                                        <div class="d-flex">
                                                            <!--begin::Checkbox-->
                                                            <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                                <input class="form-check-input" type="checkbox" value="" name="content_management_read" />
                                                                <span class="form-check-label">Просмотр</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                            <!--begin::Checkbox-->
                                                            <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                                <input class="form-check-input" type="checkbox" value="" name="content_management_write" />
                                                                <span class="form-check-label">Изменение</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                            <!--begin::Checkbox-->
                                                            <label class="form-check form-check-sm form-check-custom form-check-solid">
                                                                <input class="form-check-input" type="checkbox" value="" name="content_management_create" />
                                                                <span class="form-check-label">Создание</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                        </div>
                                                        <!--end::Wrapper-->
                                                    </td>
                                                    <!--end::Options-->
                                                </tr>
                                                <!--end::Table row-->
                                                <!--begin::Table row-->
                                                <tr>
                                                    <!--begin::Label-->
                                                    <td class="text-gray-800">Экспорт документов</td>
                                                    <!--end::Label-->
                                                    <!--begin::Options-->
                                                    <td>
                                                        <!--begin::Wrapper-->
                                                        <div class="d-flex">
                                                            <!--begin::Checkbox-->
                                                            <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                                <input class="form-check-input" type="checkbox" value="" name="financial_management_read" />
                                                                <span class="form-check-label">Просмотр</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                            <!--begin::Checkbox-->
                                                            <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                                <input class="form-check-input" type="checkbox" value="" name="financial_management_write" />
                                                                <span class="form-check-label">Изменение</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                            <!--begin::Checkbox-->
                                                            <label class="form-check form-check-sm form-check-custom form-check-solid">
                                                                <input class="form-check-input" type="checkbox" value="" name="financial_management_create" />
                                                                <span class="form-check-label">Создание</span>
                                                            </label>
                                                            <!--end::Checkbox-->
                                                        </div>
                                                        <!--end::Wrapper-->
                                                    </td>
                                                    <!--end::Options-->
                                                </tr>
                                                <!--end::Table row-->
                                            </tbody>
                                            <!--end::Table body-->
                                        </table>
                                        <!--end::Table-->
                                    </div>
                                    <!--end::Table wrapper-->
                                </div>
                                <!--end::Permissions-->
                            </div>
                            <!--end::Scroll-->
                            <!--begin::Actions-->
                            <div class="text-center pt-15">
                                <button type="reset" class="btn btn-light me-3" data-kt-roles-modal-action="cancel">Отменить</button>
                                <button type="submit" class="btn btn-primary" data-kt-roles-modal-action="submit">
                                    <span class="indicator-label">Отправить</span>
                                    <span class="indicator-progress">Пожалуйста подождите...
                                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                </button>
                            </div>
                            <!--end::Actions-->
                        </form>
                        <!--end::Form-->
                    </div>
                    <!--end::Modal body-->
                </div>
                <!--end::Modal content-->
            </div>
            <!--end::Modal dialog-->
        </div>
        <!--end::Modal - Update role-->
        <!--end::Modals-->
    </div>
    <!--end::Container-->
</div>
<!--end::Post-->
</div>
<!--end::Container-->
@endsection
