@if(isset($json["fees"]))
     
<div class="modal fade" id="RequestModalLabel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content modal-content-request">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Request Different Fees</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>

         <div class="modal-body">

            @foreach($json["fees"]["fee_type"] as $fee_type => $fees)
            
            @if(isset($fees["amount"]))

                <div class="text-xs py-1">
                   <label for="message-text" class="col-form-label">Enter New {{ $fees["name"] }}:</label>
                   <input data-form="set" placeholder="@if($fees['type'] == 'flat') ${{ number_format($fees['amount'],2) }} @else {{ $fees['amount'] }}% @endif" class="form-control text-sm" autocomplete="off" data-type="{{ $fees['type'] }}" maxlength="25" type="text" name="{{$fee_type}}">
                </div>

            @else

                @foreach($fees["list"] as $lists => $list)
                <div class="text-xs py-1">
                   <label for="message-text" class="col-form-label">Enter New {{ $list['name'] }}:</label>
                   <input data-form="set" placeholder="@if($list['type'] == 'flat') ${{ number_format($list['amount'],2) }} @else {{ $list['amount'] }}% @endif" class="form-control text-sm" autocomplete="off" data-type="{{ $list['type'] }}" maxlength="25" type="text" name="{{ $lists }}">
                </div>
                @endforeach

            @endif

            @endforeach

            <div class="request-form-container pt-4">

                <div class="text-xs py-1">
                    <label for="message-text" class="col-form-label">Request New Fee/Expense</label>
                </div>


                <div class=" py-1">
                   <input placeholder="Enter Name/Type of Fee" class="form-control request_name_input text-xs" autocomplete="off" maxlength="50" type="text" name="request_name">
                </div>


                <div class=" py-1">
                    
                    <input placeholder="Enter Amount" class="form-control text-xs request_amount_input" autocomplete="off" maxlength="25" type="number" name="request_amount">
                    <select name="request_type" class="form-control request_type_select border-0 w-4/12 text-xs">
                       <option value="flat">$ (Flat)</option>
                       <option value="interest">% (Percentage)</option>
                    </select>

                </div>

            </div>

         </div>


         <div class="modal-footer">
            <button type="button" class="bg-red-500 text-white rounded py-2 px-6 text-sm" data-bs-dismiss="modal">Close</button>
            <button type="button" id="send_request" class="main-bg-c text-white rounded py-2 px-6 text-sm">Send</button>
         </div>
         
      </div>
   </div>
</div>

@endif


<script type="text/javascript">
        
        $("#send_request").click(function(){

            var array = [];

            $("#RequestModalLabel input[data-form=set]").each(function(){

                if ($(this).val()) {
                    array.push({
                        status:"valid",
                        name : $(this).attr('name'), 
                        value : $(this).val(),
                        type:$(this).attr('data-type')
                    });
                }

            });

            if (!$("input[name=request_name]").val().trim() == '' && !$("input[name=request_amount]").val().trim() == '') {
                    array.push({
                        status:"new",
                        name : $("input[name=request_name]").val(), 
                        value : $("input[name=request_amount]").val(),
                        type: $("select[name=request_type]").val()
                    });
            }


            $.ajax({
                url: window.origin+"/send-platform-request",
                headers: { "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content") },
                method: "POST",
                data:{
                    "platform":"{{ $page }}",
                    "array":array
                },
                success: function (e) {
                    $('#RequestModalLabel').modal('hide');
                    console.log(e);
                    popup("green","Request Sent!");
                    $("#RequestModalLabel input").val('');
                },
                error: function (e, a, t) {
                    console.log(e);
                    popup("red","Error. Please try again!");
                },
            });


        });

</script>