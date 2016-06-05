@extends('layouts.app')

@section('details')
<li><a href="{{ action('StudentsController@show', [Auth::user()->id]) }}" ><i class="fa fa-btn fa-info"></i>Details</a></li>
<li><a href="{{ action('StudentsController@showTeams') }}" ><i class="fa fa-btn fa-info"></i>Show Teams</a></li>
<li><a href="{{ action('StudentsController@showStudents') }}" ><i class="fa fa-btn fa-info"></i>Show Students</a></li>
@if ($student->team)
    <li><a href="{{ action('StudentsController@showTeam', [$student->team->id]) }}" ><i class="fa fa-btn fa-info"></i>My Team</a></li>
@else
    <li><a href="{{ url('students/applications') }}"><i class="fa fa-btn fa-info"></i>My Applications</a></li>
@endif

@if ($student->is_leader)
	<li><a href="{{ url('students/team/delete') }}" ><i class="fa fa-btn fa-info"></i>Disband Team</a></li>
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
               $.get('/students/notifications', function(data){
                    var currentLength = $('ul#myMenu li').length;

                    for (var i=0; i<data.length; i++)
                    {
                         $('#myMenu').prepend(
                            $('<li>')
                            .css('width', '30em')
                            .append($('<div>')
                                    .append(
                                        $('<div>')
                                        .attr('class', 'col-md-10')
                                        .append($('<p>')
                                                .text(data[i].text)))
                                    .append($('<div>')
                                            .attr('class', 'col-md-1')
                                            .append($('<div>')
                                                    .attr({'class': 'fa fa-check', 'data-check': true, 'data-notification-id': data[i].id, 'name': 'notification'})))
                                    .append($('<div>')
                                            .attr('class', 'col-md-1')
                                            .append($('<div>')
                                                    .attr({'class': 'fa fa-times', 'data-check': false, 'data-notification-id': data[i].id, 'name': 'notification'})))));



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
            var url = '/action/' + $(this).data('notification-id') + '/' + $(this).data('check');
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