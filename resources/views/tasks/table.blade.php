@push('third_party_stylesheets')

    <!-- Datatables Js-->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.12/datatables.min.css"/>

@endpush
<div class="table-responsive">
    <table class="table" id="tasks-table">
        <thead>
        <tr>
            <th style="width: 8px"></th>
        <th>Task Name</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody id="tablecontents">
        @foreach($tasks as $task)
            <tr class="row1" data-id="{{ $task->id }}">
                <td><span style="visibility: hidden">{{ $task->priority }}</span></td>
                <td>{{ $task->task_name }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['tasks.destroy', $task->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('tasks.show', [$task->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('tasks.edit', [$task->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-edit"></i>
                        </a>
                        {!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

@push('third_party_scripts')
    @include('layouts.task_index_datable')

    <script type="text/javascript">

        $(function () {
            $("#tasks-table").DataTable({
                "columnDefs": [ {
                    "targets": [ 0, 1, 2 ],
                    "orderable": false
                } ],
                "order": [[0, 'asc']],

            });


            $( "#tablecontents" ).sortable({
                items: "tr",
                cursor: 'move',
                opacity: 0.6,
                update: function() {
                    sendOrderToServer();
                }
            });

            function sendOrderToServer() {

                var order = [];
                $('tr.row1').each(function(index,element) {
                    order.push({
                        id: $(this).attr('data-id'),
                        position: index+1
                    });
                });


                $.ajax({
                    type: "POST",
                    dataType: "json",
                    url : "{{ url('tasks/ordering') }}",
                    data: {
                        order:order,
                        _token: '{{csrf_token()}}'
                    },
                    success: function(response) {
                        //todo success code going here
                    }
                });

            }


        });
    </script>

@endpush
