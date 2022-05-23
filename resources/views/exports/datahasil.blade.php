<table class="table">
    <thead class="thead-dark">
        <tr>
       
            <th scope="col">Tanggal</th>
            <th scope="col">jumlah Mesin</th>
            <th scope="col">Jam Aktif/mesin</th>
            <th scope="col">Watt</th>
            <th scope="col">income</th>
            <th scope="col">Listrik</th>
            <th scope="col">Biaya Listrik IDR</th>
            <th scope="col">Investor</th>
            <th scope="col">Rate</th>
            <th scope="col">Pendapatan Investor</th>
        </tr>
    </thead>
    <tbody>
        <?php $no = 0 ?>
        @foreach($miner as $db)
        <?php $no++  ?>
        {{-- <p> {{ number_format($db->sum, 9) }}</p>
        <p>{{ $db->tanggal }}</p> --}}
        <tr>
            <td>{{  \Carbon\Carbon::parse($db->tgl )->format('d M Y') }}</td>
            <td>{{ $db->mesincount }}</td>
            <td>{{ $db->active_mesin }}</td>
            <td>{{ $db->watt }}</td>
            <td>{{ number_format($db->nilaisbr,9) }}</td>
            <td>{{ number_format($db->listrik,9) }}</td>
            <td>{{ "Rp " . number_format($db -> ratelistrik, 0, ",", ".") }}</td>
            <td>{{ number_format($db->investor,9) }}</td>
            <td>{{"Rp " . number_format( $db->rate, 0, ",", ".")  }}</td>
            <td>{{"Rp " . number_format( $db->akumulasi, 0, ",", ".")  }}</td>
        </tr>
        @endforeach
    </tbody>
</table>