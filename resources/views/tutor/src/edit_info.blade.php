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
          $(function(){
              //Initialize Select2 Elements
                $('.select2').select2();
                $('.select2').select2();

                //Initialize Select2 Elements
          });
    </script>
  @endpush