@extends('layouts.app')

@section('details')
<li><a href="{{ action('StudentsController@show', [Auth::user()->id]) }}" ><i class="fa fa-btn fa-info"></i>Details</a></li>

@if ($student->team)
    <li><a href="{{ url('students/team/show') }}" ><i class="fa fa-btn fa-info"></i>My Team</a></li>
@endif

@if ($student->is_leader)
	<li><a href="{{ url('students/team/delete') }}" ><i class="fa fa-btn fa-info"></i>Disband Team</a></li>
	<li><a href="{{ url('students/list') }}" ><i class="fa fa-btn fa-info"></i>Show Eligible Students</a></li>
@else
	@if ($student->team)
		<li><a href="{{ url('students/team/leave', [$student->team->id]) }}" ><i class="fa fa-btn fa-info"></i>Leave Team</a></li>
	@else
		<li><a href="{{ url('students/team/create') }}" ><i class="fa fa-btn fa-info"></i>Create Team</a></li>
	@endif
@endif

@endsection

@section('scripts')
<script type="text/javascript">

    $(document).ready(function(){

        (function poll() {
           setTimeout(function() {
               $.get('http://192.168.99.100/students/notifications', function(data){
                    var currentLength = $('ul#myMenu li').length;

                    for (var i=0; i<data.length; i++)
                    {
                        $('#myMenu').prepend(
                            $('<li>').append(
                                $('<div>').attr('class', 'row').append(
                                    $('<div>').attr('class', 'col-md-8').append(
                                        $('<span>').attr('class', 'label label-default').text(data[i].text)
                                    )
                                ).append(
                                    $('<div>').attr('class', 'col-md-4').append(
                                        $('<div>').attr({'class': 'fa fa-check', 'data-check': true, 'data-notification-id': data[i].id, 'name': 'notification'})
                                    ).append(
                                        $('<div>').attr({'class': 'fa fa-times', 'data-check': false, 'data-notification-id': data[i].id, 'name': 'notification'})
                                    )
                                )
                                
                        ));

                        $("ul#myMenu > li:first > div > div[class='col-md-4'] > div[data-check=false]").each(function(){
                            if (data[i].info_only)
                            {
                                $(this).attr('hidden', data[i].info_only);
                            }
                        });
                        
                    }
                    if(currentLength != null && data.length + currentLength > 0)
                    {
                        $('#notify').text(data.length + currentLength);
                        $('#notify').show();
                    }
                    
                    
                }).done(poll).fail(function(data){

                    if(data.responseText.length > 0)
                    {
                        var w = window.open();
                        $(w.document.body).html(data.responseText);
                    }
                    
                });
            }, 5000);
        })();

        $(document).on('click', 'div[name=notification]', function(){
            var url = 'http://192.168.99.100/action/' + $(this).data('notification-id') + '/' + $(this).data('check');
            var dom = $(this);

            $.get(url, function(data){
                dom.closest('li').remove();
                var currentLength = $('ul#myMenu li').length;

                if(currentLength > 0 && currentLength != null)
                {
                    $('#notify').text(currentLength);
                    $('#notify').show();
                }else
                {
                    $('#notify').hide();
                }


            }).fail(function(data){
                alert(data.toString() +  " FAILED");
            });
        });

        $('#notifications').on('click', function(){

            $('#notify').hide();

        });


    });

</script>

@endsection