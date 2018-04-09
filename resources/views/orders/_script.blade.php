<script>
    $(document).ready(function () {

        var dt = $('table#order').DataTable({
            responsive: true,
            processing: true,
            serverSide: true,
            ajax: '{{ url()->route("api.orders.index") }}',
            columns: [
                {data: 'id'},
                {data: 'buyer'},
                {data: 'account.name', "defaultContent": "<span class='text-danger'>Not set</span>"},
                {data: 'user.name', "defaultContent": "<span class='text-danger'>Not set</span>"},
                {data: 'address'},
                {data: 'item'},
                {data: 'price'},
                {data: 'last_update', "defaultContent": "<span class='text-danger'>Not set</span>"},
                {data: 'status'},
                {data: 'note'},
                {data: 'action', orderable: false, searchable: false},
            ],
            order: [[1, 'desc']],
        });

    });
</script>
