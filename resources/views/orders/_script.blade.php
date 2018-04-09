<script>
    $(document).ready(function () {

        var dt = $('table#order').DataTable({
            responsive: true,
            processing: true,
            serverSide: true,
            ajax: '{{ url()->route("api.orders.index") }}',
            columns: [
                {data: null, searchable: false,  "orderable": false, "defaultContent": ""},
                {data: 'id'},
                {data: 'buyer'},
                {data: 'account.name', "defaultContent": "<span class='text-danger'>Not set</span>"},
                {data: 'user.name', "defaultContent": "<span class='text-danger'>Not set</span>"},
                {data: 'address'},
                {data: 'item'},
                {data: 'price'},
                {data: 'last_update', "defaultContent": "<span class='text-danger'>Not set</span>"},
                {data: 'tracking', "defaultContent": "<span class='text-danger'>Not set</span>"},
                {data: 'status'},
                {data: 'note'},
                {data: 'action', orderable: false, searchable: false},
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

    });
</script>
