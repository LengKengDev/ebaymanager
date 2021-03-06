<script>
    $(document).ready(function () {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var dt = $('table#order').DataTable({
            responsive: true,
            processing: true,
            serverSide: true,
            ajax: '{{ url()->route("api.orders.index") }}',
            columns: [
                {data: null, searchable: false,  "orderable": false, "defaultContent": ""},
                {data: 'id', {!! Auth::user()->can('views_full') ? "name: 'orders.id'" : ''!!}},
                @if(Auth::user()->can('views_full'))
                    {data: 'buyer'},
                    {data: 'account.name', "defaultContent": "<span class='text-danger'>Not set</span>", class: 'account'},
                    {data: 'user.name', "defaultContent": "<span class='text-danger'>Not set</span>", class: 'user'},
                @endif
                {data: 'address'},
                {data: 'item'},
                {data: 'price'},
                {data: 'last_update', "defaultContent": "<span class='text-danger'>Not set</span>"},
                {data: 'tracking'},
                {data: 'status', class: 'status'},
                {data: 'note', name: "note"},
                {data: 'action', orderable: false, searchable: false},
                {data: 'email', visible: false},
                {data: 'number', visible: false}
            ],
            order: [[1, 'desc']],
            select: {
                style:    'multi',
                selector: 'td:first-child'
            },
            columnDefs: [ {
                searchable: false,
                orderable: false,
                className: 'select-checkbox',
                targets:   0
            } ],
            "createdRow": function( row, data, dataIndex){
                if( data.is_tracking ==  "0"){
                    $(row).addClass('blue-class');
                }
            }
        });


        $('.select-all[type=checkbox]').change(function() {
            if($(this).is(":checked")) {
                dt.rows().select();
            } else {
                dt.rows().deselect();
            }
        });

        jQuery.fn.addHidden = function (name, value) {
            return this.each(function () {
                var input = $("<input>").attr("type", "hidden").attr("name", name).val(value);
                $(this).append($(input));
            });
        };

        $('#assign').submit(function (e) {
            var length = dt.rows( { selected: true } ).count();
            var data = dt.rows( { selected: true } ).data();
            if (length > 0) {
                for(var i = 0; i < length; i++) {
                    $('#assign').addHidden(`ids[${i}]`, data[i].id);
                }
            }
        });

        $('#delete').submit(function (e) {
            var length = dt.rows( { selected: true } ).count();
            var data = dt.rows( { selected: true } ).data();
            if (length > 0) {
                for(var i = 0; i < length; i++) {
                    $('#delete').addHidden(`ids[${i}]`, data[i].id);
                }
            }
        });

        $('select#account').change(function () {
            var val = $(this).val();
            dt.columns( '.account')
                .search(val, false, false, false)
                .draw();
        });

        $('select#user').change(function () {
            var val = $(this).val();
            dt.columns( '.user')
                .search(val, false, false, false)
                .draw();
        });
        
        $('#only-new').change(function () {
            if (this.checked) {
                dt.columns( '.status')
                    .search('order_new', false, false, false)
                    .draw();
            } else {
                dt.columns( '.status')
                    .search('', false, false, false)
                    .draw();
            }
        });
        
        $(document).on("click", ".btn-status", function () {
            var url = $(this).attr("href");
            $.get(url).always(function() {
                dt.ajax.reload(null, false);
            });
        });

    });
</script>
