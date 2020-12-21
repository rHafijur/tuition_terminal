@push('css')
      <!-- Select2 -->
  <link rel="stylesheet" href="{{asset('admin_lte/plugins/select2/css/select2.min.css')}}">
  <link rel="stylesheet" href="{{asset('admin_lte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
@endpush
@push('js')
    <!-- Select2 -->
<script src="{{asset('admin_lte/plugins/select2/js/select2.full.min.js')}}"></script>
@endpush
<div class="card">
    <div class="card-header p-2">
      <ul class="nav nav-pills">
        <li class="nav-item"><a class="nav-link @if(request()->tab=='ti' || request()->tab==null) active @endif" href="#activity" data-toggle="tab">Tutoring related Information</a></li>
        <li class="nav-item"><a class="nav-link @if(request()->tab=='ei') active @endif" href="#education" data-toggle="tab">Educational Information</a></li>
        <li class="nav-item"><a class="nav-link @if(request()->tab=='pi') active @endif" href="#settings" data-toggle="tab">Personal Infromation</a></li>
      </ul>
    </div><!-- /.card-header -->
    <div class="card-body">
      <div class="tab-content">
        <div class="@if(request()->tab=='ti' || request()->tab==null) active @endif tab-pane" id="activity">
            @include('tutor.src.edit_tutoring_info')
        </div>
        <!-- /.tab-pane -->
        <div class="@if(request()->tab=='ei') active @endif tab-pane" id="education">
          @include('tutor.src.edit_educational_info')
        </div>
        <!-- /.tab-pane -->

        <div class="@if(request()->tab=='pi') active @endif tab-pane" id="settings">
          @include('tutor.src.edit_personal_info')
        </div>
        <!-- /.tab-pane -->
      </div>
      <!-- /.tab-content -->
    </div><!-- /.card-body -->
  </div>
  @push('js')
      <script>
        var masters_html="";
        function otherClicked(obj,num){
          var el=$($(".ins_"+num)[0]);
          el.html(`
          <label>Institute</label>
          <input required type="text" name="institute[`+num+`]" placeholder="Please Enter the Institute Name"  class="form-control">
          `);
          $(obj).closest(".select2-container").remove();
        }
        function otherButton(){
          return `
        <button class="btn btn-secondary" onclick="otherClicked(this)">Other</a>
        `;
        };
        function insSelect2(num){
            $('.select2_'+num).select2({
              language: {
                noResults: function(){
                return `
                <button class="btn btn-secondary" onclick="otherClicked(this,`+num+`)">Other</a>
                `;
                }
              },
              escapeMarkup: function(markup) {
                return markup;
              },
          });
        }
        function hasMasterChanged(){
          if(document.getElementById('has_masters').checked){
            $("#masters").html(masters_html);
            $(".select2_masters").select2();
            $(".select2_masters").select2();
            insSelect2(3);
            insSelect2(3);
          }else{
            $("#masters").empty();
          }
        }
          $(function(){
              //Initialize Select2 Elements
                $('.select2').select2();
                $('.select2').select2();
                var arr=[6,5,4];
                for(var n of arr){
                  insSelect2(n);
                  insSelect2(n);
                }

                masters_html=$("#masters").html();
                hasMasterChanged();
                

                //Initialize Select2 Elements
          });
    </script>
  @endpush