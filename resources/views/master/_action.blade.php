
<ul class="icons-list">
    <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <i class="icon-menu9"></i>
        </a>
        <ul class="dropdown-menu dropdown-menu-right">
            @if (isset($edit))
                {{-- <li><a href="#" onclick="edit('{!! $edit !!}')"><i class="icon-printer2"></i> Edit</a></li> --}}
                <li><a href="{!! $edit !!}"><i class="icon-pencil6"></i> Edit</a></li>
            @endif

            @if (isset($delete))
                <li><a data-link="{!!$delete!!}" class="delete-button"><i class="icon-x"></i> Delete</a></li>
            @endif
        </ul>
    </li>
</ul>


<script>
    $(document).ready(function() {

        $('.delete-button').click(function(){

            let link = $(this).data('link');

            Swal.fire({
                title: 'Do you want to delete ?',
                showDenyButton: true,
                showCancelButton: false,
                confirmButtonText: 'Delete',
                denyButtonText: `Don't Delete`,
                }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    $.ajax({
                        type: 'get',
                        url: link,
                        success: function(data){
                            Swal.fire('Saved!', '', 'success');
                            dtable.draw();
                        }
                    })
                } else if (result.isDenied) {
                    Swal.fire('Changes are not saved', '', 'info');
                }
            })
        })
    })
</script>
