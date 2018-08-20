<table class="table table-hover">
    <thead>
    <tr>
        <th>#</th>
        <th>Amount</th>
        <th>Pirce</th>
        <th>Date</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($sql as $key => $value)
        <tr>
            <th scope="row">{!! $key+1 !!}</th>
            <td>{!! $value['amounts'] !!}</td>
            <td>{!! $value['amounts'] !!}</td>
            <td>{!! $value['created_at'] !!}</td>
        </tr>
    @endforeach
    </tbody>
</table>