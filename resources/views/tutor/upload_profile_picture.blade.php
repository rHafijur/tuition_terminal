@extends('tutor.layouts.master',['title'=>'Change Profile Picture'])
@push('css')
<link rel="stylesheet" href="{{asset('css/croppie.css')}}">
<style>
    [type="file"] {
  height: 0;
  overflow: hidden;
  width: 0;
}
    .upload-demo .upload-demo-wrap,
.upload-demo .upload-result,
.upload-demo.ready .upload-msg {
	display: none;
}

.upload-demo.ready .upload-demo-wrap {
	display: block;
}

.upload-demo.ready .upload-result {
	display: inline-block;
}

.upload-demo-wrap {
	width: 300px;
	height: 300px;
	margin: 0 auto;
}

.upload-msg {
	text-align: center;
	padding: 50px;
	font-size: 22px;
	color: #aaa;
	width: 260px;
	margin: 50px auto;
	border: 1px solid #aaa;
}

@media handheld,
only screen and (max-width: 767px) {
	.grid {
		width: 100%;
		min-width: 0;
		margin-left: 0;
		margin-right: 0;
		padding-left: 20px;
		/* grid-space to left */
		padding-right: 10px;
		/* grid-space to right: (grid-space-left - column-space) e.g. 20px-10px=10px */
	}

	[class*='col-'] {
		width: auto;
		float: none;
		margin: 10px 0;
		padding-left: 0;
		padding-right: 10px;
		/* column-space */
	}

	.container,
	.section-header h2 {
		min-width: 0;
	}

	.croppie-container {
		padding: 30px 0;
    }
    .actions{
        margin-top: 70px;
    }
    .cr-slider-wrap{
        margin-bottom: 20px;
        display: block;
    }
}
</style>
@endpush
@section('content')
<div class="row">
    <div class="col-md-12">

        <div class="card-header">
            {{-- <h3 class="card-title">Change Password</h3> --}}
        </div>
      <div class="card card-primary card-outline">
        <div class="card-body box-profile">

            <div class="demo-wrap upload-demo">
                <div>
                    @php
                        $user=auth()->user();
                    @endphp
                    <img id="profile-image" src="@if($user->photo!=null){{url($user->photo)}}@else {{url("/img/profile.png")}} @endif" width="100px" height="100px" alt="">
                </div>
                <div class="upload-msg">
                    Upload a file to start cropping
                </div>
                <div class="upload-demo-wrap">
                    <div id="upload-demo"></div>
                </div>
                
            </div>
            
        </div>
                
        <!-- /.card-body -->
        <div class="card-footer" style="margin-top: 20px">
            <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#photoInstruction">
                Photo Upload Instructions
            </button>
            <a class="btn file-btn">
                {{-- <span>Upload</span> --}}
                <input type="file" id="upload" value="Choose a Image" accept="image/*" />
                <label class="btn btn-primary" for="upload">Choose a Image</label>
            </a>
            <button class="upload-result btn btn-success">Update</button>
        </div>
      </div>
      <form id="img_form" action="{{route('tutor_update_profile_picture')}}" method="POST">
        @csrf
        <input type="hidden" name="image" id="img_data">
      </form>
      <!-- /.card -->
    </div>
  </div>
  <!-- Modal -->
<div class="modal fade" id="photoInstruction" tabindex="-1" aria-labelledby="photoInstructionLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="photoInstructionLabel">Photo Upload Instructions</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="uk-margin-medium-bottom">
                <p>You have excellent educational background and good experience of tutoring, but you’re having a hard time to find new tuitions. Sound familiar? If so, consider the first impression your profile makes with prospective client.</p>
                <p>Your profile is how you present yourself to the world. And if a picture is worth a thousand words, what does your profile picture say about you? Does it say you’re friendly, professional, and easy to get along with?</p>
                <p>Client look at profile photos to get a sense of who you are…and if they don’t see a photo that conveys friendliness and professionalism, you may get overlooked. To help you attract client and stand out from the crowd, keep these guidelines in mind when you’re snapping your pics.</p>
    
                <ol>
                    <li>
                        <h4>Find your best light</h4>
                        <p>Shady areas outdoors, without direct sunlight, are a great lighting choice. Inside, avoid overhead light, which creates harsh shadows, and instead look for natural light.</p>
                    </li>
                    <li>
                        <h4>Simplify the background</h4>
                        <p>Look for a background that is clear and uncluttered. A solid, not-too-bright wall or simple outdoor background works well.</p>
                    </li>
                    <li>
                        <h4>Focus on your face</h4>
                        <p>Face the camera straight on or with your shoulders at a slight angle. Crop so that you only include your head and the top of your shoulders.</p>
                    </li>
                    <li>
                        <h4>Smile! (You’ll land more jobs)</h4>
                        <p>Clients find smiling tutors more warm, friendly, and trustworthy. Not used to smiling for the camera? Try pretending that you are greeting your best friend.</p>
                    </li>
                </ol>
    
                <h3 class="uk-modal-title">Do &amp; Don't Examples (Male)</h3>
                <img src="{{url('img/male.png')}}" class="img-fluid">
                <h3 class="uk-modal-title">Do &amp; Don't Examples (Female)</h3>
                <img src="{{url('img/female.png')}}" class="img-fluid">
            </div>
        </div>
      </div>
    </div>
  </div>
@endsection
@push('js')
<script src="{{asset('js/croppie.min.js')}}"></script>
<script>
    var Demo = (function () {

function demoUpload() {
    var $uploadCrop;
    function readFile(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('.upload-demo').addClass('ready');
                $uploadCrop.croppie('bind', {
                    url: e.target.result
                }).then(function () {
                    console.log('jQuery bind complete');
                });

            };

            reader.readAsDataURL(input.files[0]);
        } else {
            alert("Sorry - you're browser doesn't support the FileReader API");
        }
    }

    $uploadCrop = $('#upload-demo').croppie({
        viewport: {
            width: 200,
            height: 200,
            type: 'square'
        },
        enableExif: true
    });

    $('#upload').on('change', function () {
        readFile(this);
    });
    $('.upload-result').on('click', function (ev) {
        $uploadCrop.croppie('result', {
            type: 'base64',
            size: 'original'
        }).then(function (resp) {
            $('#profile-image').attr('src', resp);
            $('#img_data').val(resp);
            $('#img_form').submit();
            // popupResult({
            // 	src: resp
            // });
        });
    });
}

function init() {
    demoUpload();
}

return {
    init: init
};
})();
Demo.init();
</script>
@endpush
