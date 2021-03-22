@foreach($results as $row => $biodata)
<?php 
if ($biodata->fileDiri) {
    $foto='https://simpegterpadu.ponorogo.go.id/files_scan/'.$biodata->fileDiri->file_foto;
} else {
    $foto = 'https://www.google.com/url?sa=i&url=https%3A%2F%2Fpiotrkowalski.pw%2Fen%2Fdjango-filer-image-uploaded-but-not-showing&psig=AOvVaw2u9TV1JdmEJvPNWQ9AgHat&ust=1613608086857000&source=images&cd=vfe&ved=0CAIQjRxqFwoTCNiX5-TU7-4CFQAAAAAdAAAAABAJ';
};?>
<tr id="tr-{{$biodata->pegawai_id}}">
    <td><img style="width:100px; height:auto" src="{{ $foto}}" alt=""></td>
    <td class="text-left">{{$biodata->nama}}</td>
    <td>{{$biodata->suamiIstri? 'Rabi' : 'Jomblo'}}</td>
    <td>{{$biodata->nip_baru}}</td>
    <td>{{$biodata->tgl_lahir}}</td>
    <td>{{$biodata->no_hp}}</td>
    <td>
        <a target="_blank" href="https://www.facebook.com/search/people/?q={{$biodata->nama}}" data-toggle="tooltip" title="Edit">
            <button class="btn btn-default btn-icon-anim btn-sm">Search To FB</button>
        </a>
        
    </td>
</tr>
@endforeach