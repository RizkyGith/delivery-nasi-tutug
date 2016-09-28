@extends('skeleton')

<?php 
    use ROH\Util\Inflector;
    use App\Library\Pagination;
 ?>

<?php
$schema = array();
foreach (f('controller')->schema() as $key => $field) {
    if ($field['list-column']) {
        $schema[$key] = $field;
    }
}
?>

@section('pagetitle')
   {{ Inflector::pluralize(Inflector::humanize(f('controller')->getClass())) }}
@stop


@section('tabssearch')
@stop

@section('menu')
@stop

    @section('content')
        <div class="wrapper">
            <h4 class="sub-title">Tentang Kami</h4>
            <p class="hover">
                <strong>Nasi Tutug Oncom</strong> atau <strong>Sangu Tutug Oncom</strong> dalam Bahasa Sunda sering disingkat Nasi T.O adalah makanan yang
                dibuat dari nasi yang diaduk dengan oncom goreng atau bakar. Penyajian makanan ini umumnya dalam keadaan hangat. <br /> <br />

                Secara bahasa, kata tutug dalam Bahasa Sunda artinya menumbuk. Proses aduk-tumbuk nasi dengan oncom ini
                menjadi nama jenis makanan yang dikenal dengan nama tutug oncom. <br /> <br />

                <strong>Nasi Tutug Oncom Bumbu Sunda Pamulang</strong>

                <ul class="">
                <li class="first-child odd"><strong>Alamat : </strong> Jl. Pamulang Permai I Blok AX 33/21 (Belakang Giant Supermarket Pamulang)</li>
                <li class="first-child odd"><strong>Kota : </strong> Tangerang Selatan </li>
                <li class="first-child odd"><strong>Provinsi : </strong> Banten </li>
                <li class="first-child odd"><strong>No Telepon : </strong> 021-92843568 / 021-98736448 </li>
            </ul> <br />

            </p> <br /> <br />
        </div>
    @endsection

@stop


