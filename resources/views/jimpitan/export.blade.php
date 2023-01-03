<table>
    <thead>
        <tr>
            <th width="50%">NO</th>
            <th width="500%">NAMA</th>
            <th width="500%">No KK</th>
            <th>RT</th>
            <th>RW</th>
            <th>NOMINAL</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($laporan as $index => $item)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $item->nama_lengkap }}</td>
                <td>{{ $item->no_kk }}</td>
                <td>{{ $item->rt }}</td>
                <td>{{ $item->rw }}</td>
                <td>{{ $item->nominal }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
