@extends('layouts.app')
<style>
    .password{
        width: 100%;
    }
    .password + .unmask {
        position: absolute;
        right: 22px;
        top: 50%;
        -webkit-transform: translateY(-50%);
        -ms-transform: translateY(-50%);
        transform: translateY(-50%);
        text-indent: -9999px;
        width: 25px;
        height: 25px;
        /*background: #aaa;*/
        /*border-radius: 50%;*/
        cursor: pointer;
        border: none;
        -webkit-appearance: none;
    }

    .password + .unmask:before {
        content: "";
        position: absolute;
        top: 4px;
        left: 4px;
        width: 17px;
        height: 17px;
        background: #e3e3e3;
        z-index: 1;
        border-radius: 50%;
    }

    .password[type="text"] + .unmask:after {
        content: "";
        position: absolute;
        top: 6px;
        left: 6px;
        width: 13px;
        height: 13px;
        background: #aaa;
        z-index: 2;
        border-radius: 50%;
    }

</style>
@section('content')
    <div class="container">
        <form id="product-info" class="form-horizontal" method="POST" action="{{route('user.store_newpassword',['id'=>Auth::user()->id])}}">
            {{ csrf_field() }}
            <input type="hidden" name="active_image" class="active_image" value="0">
            <div class="row">


                <div class="col-sm-6">
                    @foreach ($errors->all() as $error)
                        <p class="text-danger">{{ $error }}</p>
                    @endforeach

                    <div class="form-group">
                        <label for="password" class="col-md-4 col-form-label ">Current Password</label>

                        <div class="col-md-10">
                            <input id="password" type="password" class="form-control" name="current_password" autocomplete="current-password" placeholder="Please enter your current password" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="password" class="col-md-4 col-form-label">New Password</label>

                        <div class="col-md-10">
                            <input id="new_password" type="password" class="password" name="new_password" autocomplete="current-password" placeholder="6 characters with a number and a letter"required>
                            <img src="{{asset('assets/ui-icon-pack-15-512.png')}}" class="unmask" alt="">

                        </div>
                        {{--<label for=""> 6 characters with a number and a letter</label>--}}
                    </div>

                    <div class="form-group ">
                        <label for="password" class="col-md-4 col-form-label">Retype Password</label>

                        <div class="col-md-10">
                            <input id="new_confirm_password" type="password" class="password" name="new_confirm_password" autocomplete="current-password" placeholder="Please retype your password" required>
                            <img src="{{asset('assets/ui-icon-pack-15-512.png')}}" class="unmask" alt="">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-6">
                            <button type="submit" class="password-change">SAVE CHANGES</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
@section('additional_js')
    <script>


        $(function () {


            /*
              Switch actions
            */
            $('.unmask').on('click', function(){


                if($(this).prev('input').attr('type') == 'password')
                    changeType($(this).prev('input'), 'text');

                else
                    changeType($(this).prev('input'), 'password');

                return false;
            });

            function changeType(x, type) {
                if(x.prop('type') == type)
                    return x; //That was easy.
                try {
                    return x.prop('type', type); //Stupid IE security will not allow this
                } catch(e) {
                    //Try re-creating the element (yep... this sucks)
                    //jQuery has no html() method for the element, so we have to put into a div first
                    var html = $("<div>").append(x.clone()).html();
                    var regex = /type=(\")?([^\"\s]+)(\")?/; //matches type=text or type="text"
                    //If no match, we add the type attribute to the end; otherwise, we replace
                    var tmp = $(html.match(regex) == null ?
                        html.replace(">", ' type="' + type + '">') :
                        html.replace(regex, 'type="' + type + '"') );
                    //Copy data from old element
                    tmp.data('type', x.data('type') );
                    var events = x.data('events');
                    var cb = function(events) {
                        return function() {
                            //Bind all prior events
                            for(i in events)
                            {
                                var y = events[i];
                                for(j in y)
                                    tmp.bind(i, y[j].handler);
                            }
                        }
                    }(events);
                    x.replaceWith(tmp);
                    setTimeout(cb, 10); //Wait a bit to call function
                    return tmp;
                }
            }


        });
    </script>
@endsection
