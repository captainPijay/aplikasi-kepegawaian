@extends('back_office.layouts.index')
@section('content')
<div class="container-fluid w-100 d-flex justify-content-center">
  <div class="wrapperDataTableBackOffice regular-shadow w-50">
    <div class="title_table text-center">
      <p class="h2 fw-bold">Cetak Laporan Pegawai</p>
      <p class="h4 fw-bold">Pilih Kategori</p>
    </div>

    <form action="{{ route('cetakLaporan.download') }}" method="GET" class="w-100 d-flex flex-column row-gap-4">
      <div class="row-gap-4 d-flex justify-content-center">
        <div class="col-md-8 wrapper_input_cetak d-flex" style="justify-content:space-around; flex-wrap:wrap; margin-bottom:1rem">

            <div class="d-flex" style="justify-content:center;flex-direction:column;text-align:center">
                <input id="golongan" class="inputKategori" type="radio" value="golongan" name="kategori">
                <label for="golongan" class="labelKategori"><span>Rekapitulasi Berdasarkan Golongan</span></label>

                <input id="pendidikan" class="inputKategori" type="radio" value="pendidikan" name="kategori">
                <label for="pendidikan" class="labelKategori"><span>Rekapitulasi Berdasarkan Pendidikan</span></label>

                <input id="estimasi-kenaikan-pangkat" class="inputKategori" type="radio" value="estimasi-kenaikan-pangkat" name="kategori">
                <label for="estimasi-kenaikan-pangkat" class="labelKategori"><span>Estimasi Kenaikan Pangkat</span></label>

                <input id="nik-npwp-email-nohp" class="inputKategori" type="radio" value="nik-npwp-email-nohp" name="kategori">
                <label for="nik-npwp-email-nohp" class="labelKategori"><span>NIK NPWP Email NO.HP</span></label>

                <input id="jenisKelamin" class="inputKategori" type="radio" value="jenisKelamin" name="kategori">
                <label for="jenisKelamin" class="labelKategori"><span>Jenis Kelamin</span></label>

                <input id="instansi" class="inputKategori" type="radio" value="instansi" name="kategori">
                <label for="instansi" class="labelKategori"><span>Instansi</span></label>
            </div>

        </div>
      </div>
      <div class="w-100 d-flex justify-content-center wrapper_top_section_data_table">
        <button id="btn_cetak_laporan" disabled type="submit" class="btn small-shadow btn-primary">
          <i class="ri ri-printer-line"></i>
          Cetak Laporan
        </button>
      </div>
    </form>
  </div>
</div>
<style>
    .inputKategori{
        display: none;
    }

    .labelKategori {
        position: relative;
        padding: 10px 15px;
        border: 1px solid #ccc;
        border-radius: 3px;
        cursor: pointer;
        margin: 5px;
        overflow: hidden;
        transition: color 0.35s ease-in-out;
        color: #000;
        background-color: #fff;
    }

    .labelKategori::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background-color: #2C374F;
        color: #FFFF;
        transition: left 0.35s ease-in-out;
        z-index: 0;
    }

    .labelKategori:hover::before {
        left: 0;
    }

    .labelKategori span {
        position: relative;
        z-index: 1;
        color: #000;
        transition: color 0.3s ease-in-out;
    }

    .labelKategori:hover span {
        color: #ffff;
    }

    .inputKategori:checked + .labelKategori {
        background-color: #2f436f;
    }
    .inputKategori:checked + .labelKategori span {
        color: #FFFF;
    }
</style>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const items = [...document.querySelectorAll('.inputKategori')];
        const button = document.getElementById('btn_cetak_laporan');

        function updateButtonState() {
            const anyChecked = items.some(item => item.checked);

            if (anyChecked) {
                button.removeAttribute('disabled');
            } else {
                button.setAttribute('disabled', 'true');
            }
        }

        items.forEach(item => {
            item.addEventListener('change', updateButtonState);
        });
    });
</script>

@endsection
