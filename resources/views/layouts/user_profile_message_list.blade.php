

<table class="table table-bordered">
    <thead>
        <tr>
            <th style="text-align:center;">Message</th>
            <th style="text-align:center;" width="10%">Attach</th>
            <th style="text-align:center;" width="15%">Date</th>
            <th style="text-align:center;" width="15%">@if($message_type =='sent') To @else From @endif</th>                                        
            <th style="text-align:center;" width="15%">Action</th>
            
        </tr>
    </thead>
    <tbody>
        @if(!empty($all_message))
            @if($message_type =='sent')
                @foreach($all_message as $item)               
                    <tr>
                        <td align="center">
                            @if($item->attachment == 'matri_reply')
                                {{ $item->title }} <a href="{{ url('category_view/details',[$item->post_id,'all']) }}"><b>here</b></a>
                            @else
                                <a href="{{ route('user_messages_detail',$item->id) }}">{{ substr($item->content,0,50) }}</a>
                            @endif
                        </td>
                        <td align="center">@if(!empty($item->attachment)) <a href="{{ asset('/upload/attachment/'.$item->attachment) }}" download><span><svg style="height: 13px;" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="paperclip" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="svg-inline--fa fa-paperclip fa-w-14 fa-3x"><path fill="currentColor" d="M43.246 466.142c-58.43-60.289-57.341-157.511 1.386-217.581L254.392 34c44.316-45.332 116.351-45.336 160.671 0 43.89 44.894 43.943 117.329 0 162.276L232.214 383.128c-29.855 30.537-78.633 30.111-107.982-.998-28.275-29.97-27.368-77.473 1.452-106.953l143.743-146.835c6.182-6.314 16.312-6.422 22.626-.241l22.861 22.379c6.315 6.182 6.422 16.312.241 22.626L171.427 319.927c-4.932 5.045-5.236 13.428-.648 18.292 4.372 4.634 11.245 4.711 15.688.165l182.849-186.851c19.613-20.062 19.613-52.725-.011-72.798-19.189-19.627-49.957-19.637-69.154 0L90.39 293.295c-34.763 35.56-35.299 93.12-1.191 128.313 34.01 35.093 88.985 35.137 123.058.286l172.06-175.999c6.177-6.319 16.307-6.433 22.626-.256l22.877 22.364c6.319 6.177 6.434 16.307.256 22.626l-172.06 175.998c-59.576 60.938-155.943 60.216-214.77-.485z" class=""></path></svg></span></a> @endif</td>                                        
                        <td align="center">{{ substr($item->created_at,0,16) }}</td>                                        
                        <td align="center">@if(!empty($item->user->email)){{ $item->user->name }} @else Removed User @endif</td>                                                
                        <td align="center">
                            @if($item->attachment == 'matri')
                                @if($item->accept_status != "1")
                                    <a class="delete-item" href="{{ url('send_accept',$item->id) }}" title="Accept"><b class="text-color-blue">Accept</b></a>&nbsp;&nbsp;
                                    <a class="delete-item" href="{{ route('user_messages_delete_s',$item->id) }}" title="Delete"><b>Declined</b></a>&nbsp;&nbsp;
                                @else
                                    <a class="delete-item" href="{{ url('send_accept',$item->id) }}" title="Accept"><b class="text-color-green">Accepted</b></a>&nbsp;&nbsp;
                                    <a class="delete-item" href="{{ route('user_messages_delete_s',$item->id) }}" title="Delete"><i class="fa fa-times"></i></a>
                                @endif
                                
                            @elseif($item->attachment == 'matri_reply')
                                <a class="delete-item" href="{{ route('user_messages_delete',$item->id) }}" title="Delete Message"><i class="fa fa-times"></i></a>
                            @else
                                <button type="button" class="m-r-15 btn_message_reply" @if(empty($item->user->lname)) disabled @endif style="border:none;background:transparent;color:#00a655;" data-value="{{ $item->sender }}" data-placement="top" title="Reply Message" data-toggle="modal" data-target="#myModal"><i class="fa fa-mail-reply"></i></button>
                                <a class="delete-item" href="{{ route('user_messages_delete_s',$item->id) }}" title="Delete Message"><i class="fa fa-times"></i></a>
                            @endif
                        </td>
                    </tr>               
                @endforeach
            @else
                @foreach($all_message as $item)               
                    <tr>
                        <td align="center">
                            @if($item->attachment == 'matri_reply')
                                {{ substr($item->content,0,50) }} <a href="{{ url('category_view/details',[$item->post_id,'all']) }}"><b>here</b></a>
                            @else
                                <a href="{{ route('user_messages_detail',$item->id) }}">{{ substr($item->content,0,50) }}</a>
                            @endif
                        </td>
                        <td align="center">@if(!empty($item->attachment)) <a href="{{ asset('/upload/attachment/'.$item->attachment) }}" download><span><svg style="height: 13px;" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="paperclip" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="svg-inline--fa fa-paperclip fa-w-14 fa-3x"><path fill="currentColor" d="M43.246 466.142c-58.43-60.289-57.341-157.511 1.386-217.581L254.392 34c44.316-45.332 116.351-45.336 160.671 0 43.89 44.894 43.943 117.329 0 162.276L232.214 383.128c-29.855 30.537-78.633 30.111-107.982-.998-28.275-29.97-27.368-77.473 1.452-106.953l143.743-146.835c6.182-6.314 16.312-6.422 22.626-.241l22.861 22.379c6.315 6.182 6.422 16.312.241 22.626L171.427 319.927c-4.932 5.045-5.236 13.428-.648 18.292 4.372 4.634 11.245 4.711 15.688.165l182.849-186.851c19.613-20.062 19.613-52.725-.011-72.798-19.189-19.627-49.957-19.637-69.154 0L90.39 293.295c-34.763 35.56-35.299 93.12-1.191 128.313 34.01 35.093 88.985 35.137 123.058.286l172.06-175.999c6.177-6.319 16.307-6.433 22.626-.256l22.877 22.364c6.319 6.177 6.434 16.307.256 22.626l-172.06 175.998c-59.576 60.938-155.943 60.216-214.77-.485z" class=""></path></svg></span></a> @endif</td>                                        
                        <td align="center">{{ substr($item->created_at,0,16) }}</td>                                        
                        <td align="center">@if(!empty($item->user->email)){{ $item->user->name }} @else Removed User @endif</td>                                                
                        <td align="center">
                            @if($item->attachment == 'matri')
                                @if($item->accept_status != "1")
                                    <a class="delete-item" href="{{ url('send_accept',$item->id) }}" title="Accept"><b class="text-color-blue">Accept</b></a>&nbsp;&nbsp;
                                    <a class="delete-item" href="{{ route('user_messages_delete_r',$item->id) }}" title="Delete"><b>Declined</b></a>&nbsp;&nbsp;
                                @else
                                    <a class="delete-item" href="{{ url('send_accept',$item->id) }}" title="Accept"><b class="text-color-green">Accepted</b></a>&nbsp;&nbsp;
                                    <a class="delete-item" href="{{ route('user_messages_delete_r',$item->id) }}" title="Delete"><i class="fa fa-times"></i></a>
                                @endif
                                
                            @elseif($item->attachment == 'matri_reply')
                                <a class="delete-item" href="{{ route('user_messages_delete',$item->id) }}" title="Delete Message"><i class="fa fa-times"></i></a>
                            @else
                                <button type="button" class="m-r-15 btn_message_reply" @if(empty($item->user->email)) disabled @endif style="border:none;background:transparent;color:#00a655;" data-value="{{ $item->sender }}" data-placement="top" title="Reply Message" data-toggle="modal" data-target="#myModal"><i class="fa fa-mail-reply"></i></button>
                                <a class="delete-item" href="{{ route('user_messages_delete_r',$item->id) }}" title="Delete Message"><i class="fa fa-times"></i></a>
                            @endif
                        </td>
                    </tr>               
                @endforeach
            @endif
        @endif
    </tbody>
</table>
<!-- pagination  -->
<div class="text-center">                        
    {{ $all_message->links() }}
</div>
<!-- pagination  -->