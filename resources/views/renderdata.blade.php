<table class="table table-bordered">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Email Address</th>
            <th scope="col">Name</th>
            <th scope="col">Birthday</th>
            <th scope="col">Phone</th>
            <th scope="col">IP</th>
            <th scope="col">Country</th>
        </tr>
    </thead>
    <tbody>
        @forelse ( $result as $res)
            <tr>
                <th scope="row">{{$res->ID}}</th>
                <td>{{@$res->Email_Address}}</td>
                <td>{{$res->Name}}</td>
                <td>{{$res->Birthday}}</td>
                <td>{{$res->Phone}}</td>
                <td>{{$res->IP}}</td>
                <td>{{$res->Country}}</td>
            </tr>
        @empty
        <tr>
            <td colspan="7" class="text-center"> No data found</td>
        </tr>
        @endforelse
    </tbody>

</table>

{!! $result->render("pagination::bootstrap-4") !!}
