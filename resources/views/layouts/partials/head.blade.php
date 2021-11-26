<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{ config('app.name', 'Laravel') }}</title>
  <link rel="shortcut icon" href="{{ asset('theme/dist/img/logo.png') }}" type="image/x-icon">
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('theme/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- Ekko Lightbox -->
  <link rel="stylesheet" href="{{ asset('theme/plugins/ekko-lightbox/ekko-lightbox.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('theme/dist/css/adminlte.css') }}">
    <!-- Select2 -->
  <link rel="stylesheet" href="{{ asset('theme/plugins/select2/css/select2.min.css')}}">
  <link rel="stylesheet" href="{{ asset('theme/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
  <!-- Bootstrap4 Duallistbox -->
    <!-- DataTables -->
  <link rel="stylesheet" href="{{ asset('theme/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{ asset('theme/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{ asset('theme/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
  <style type="text/css">
    #business_type,#formChangePassword,#formChangePhoto,#addGroupMemberRole,#auth_user,#submit_input,#ever_borrowed_money_1,#ever_borrowed_money_2,#nav-savings,#sv_history,#business_license,#business_account_statement,#leader_recommendation,#appointment_letter,#bank_statement,#supervisor_recommendation,#transaction_inflow_sub_category,#transaction_outflow_sub_category,#new_inflow_category,#new_outflow_category{
      display: none;
    }
    table th{
      text-transform: uppercase;
      font-size: 12px;
    }
  </style>
    <style>
    .color-palette {
      height: 35px;
      line-height: 35px;
      text-align: right;
      padding-right: .75rem;
    }

    .color-palette.disabled {
      text-align: center;
      padding-right: 0;
      display: block;
    }

    .color-palette-set {
      margin-bottom: 15px;
    }

    .color-palette span {
      display: none;
      font-size: 12px;
    }

    .color-palette:hover span {
      display: block;
    }

    .color-palette.disabled span {
      display: block;
      text-align: left;
      padding-left: .75rem;
    }

    .color-palette-box h4 {
      position: absolute;
      left: 1.25rem;
      margin-top: .75rem;
      color: rgba(255, 255, 255, 0.8);
      font-size: 12px;
      display: block;
      z-index: 7;
    }
  </style>
</head>
