@extends('back_office.layouts.index')
@section('content')
<div class="content-header">
    <div class="header-welcome">
        <h2 class="title">Halo, {{ auth()->user()->username }}</h2>
        <p class="desc">Selamat Datang Di Aplikasi Informasi Kepegawaian - Bengkulu Selatan</p>
    </div>
    <div class="header-filter">
        <select class="form-select" id="filter_data">
            <option value="all" {{ request('filter') == '' ? 'selected' : '' }}>All</option>
            <option value="daily" {{ request('filter') == 'daily' ? 'selected' : '' }}>Daily</option>
            <option value="weekly" {{ request('filter') == 'weekly' ? 'selected' : '' }}>Weekly</option>
            <option value="monthly" {{ request('filter') == 'monthly' ? 'selected' : '' }}>Monthly</option>
        </select>
        </select>
    </div>
</div>
<div class="row content-info">
    <div class="col-lg-4 col-6">
        <div class="info-box">
            <div class="info-icon">
                <i class="ri-user-fill"></i>
            </div>
            <div class="info-text">
                <p>Total Data Pegawai</p>
                <h3>{{ $dataPegawai->count() }}</h3>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-6">
        <div class="info-box">
            <div class="info-icon">
                <i class="ri-community-fill"></i>
            </div>
            <div class="info-text">
                <p>Total Operator Rumah Sakit/Puskesmas</p>
                <h3>{{ $dataAdminOpd->count() }}</h3>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-6">
        <div class="info-box">
            <div class="info-icon">
                <i class="ri-team-fill"></i>
            </div>
            <div class="info-text">
                <p>Total Data Super Admin</p>
                <h3>{{ $dataSuperAdmin->count() }}</h3>
            </div>
        </div>
    </div>
</div>
<script>
    document.getElementById('filter_data').addEventListener('change', function() {
        let selectedValue = this.value;

        let url = "{{ route('dashboard') }}";
        if (selectedValue !== 'all') {
            url += '?filter=' + selectedValue;
        }

        window.location.href = url;
    });
</script>
<style>
    .content-header {
        width: 100%;
        margin-bottom:10px;
        display:flex;
        justify-content:space-between;
        padding: 0 10px;
    }

    .content-info {
        padding: 0 10px;
    }

    .header-welcome .title {
        font-size: 24px;
        color: #212529;
        font-weight: bold;
    }

    .header-welcome .desc {
        font-size: 14px;
        color: #898989;
    }

    .header-filter .form-select {
        box-shadow: 0 1px 8px 0 rgb(0, 0, 0, 0.2);
        border: none;
        border-radius: 8px;
    }

    .content-info .info-box {
        display: flex;
        align-items: center;
        background-color: #FFF;
        box-shadow: 0 1px 8px 0 rgb(0, 0, 0, 0.2);
        border-radius: 16px;
        padding: 20px;
    }

    .content-info .info-box .info-icon {
        color: #FFF;
        background-color: #556FF6;
        width: 60px;
        height: 60px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 20px;
        font-size: 40px;
    }

    .content-info .info-box .info-text p {
        font-size: 14px;
        color: #484848;
        margin-bottom: 5px;
    }

    .content-info .info-box .info-text h3 {
        font-family: "Rubik";
        font-size: 28px;
        color: #1C2434;
        margin-bottom: 0;
    }
</style>
@endsection
