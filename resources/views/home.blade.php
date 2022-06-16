@extends('layouts.layout')

@section('content')


<!-- <div class="page-banner">
  <div class="page-banner__bg-image" style="background-image: url('/images/banner.jpg');"></div>
  <div class="page-banner__content container container--narrow">
    <h1 class="page-banner__title">Upload HTML File To Cloud Servers!</h1>
    <div class="page-banner__intro">
     
    </div>
  </div>  
</div> -->

<!-- <div class="container container--narrow page-section">
<form enctype="multipart/form-data" method="POST" action="{{ route('pages.home') }}"  style="margin-top:0px; padding:14px;">
    @csrf

    <input type="image" src="/images/amazon.png"  width="48" height="48">
    <label for=""> Bucket Name: </label>
    <input type="text" name="bucket_name" id="bucket_name"  required/>
    <label for=""> I Am Key: </label>
    <input type="text" name="bucket_key" id="bucket_key"  required/>
    <label for=""> I Am Secret Key: </label>
    <input type="text" name="bucket_skey" id="bucket_skey"  required/>

    <img src="/images/azure.png" > 
    <label for=""> Bucket Name: </label>
    <input type="text" name="bucket_name" id="bucket_name"  required/>
    <label for=""> I Am Key: </label>
    <input type="text" name="bucket_key" id="bucket_key"  required/>
    <label for=""> I Am Secret Key: </label>
    <input type="text" name="bucket_skey" id="bucket_skey"  required/>
    
    <input type="hidden" name="MAX_FILE_SIZE" value="30000" />
  
    <input name="userfile" id="userfile" type="file" value="Select HTML File" required  />
    <input type="submit" value="Upload HTML File" />
</form>
</div> -->

<div class="wrapper">
            <form enctype="multipart/form-data" method="POST" action="{{ route('pages.home') }}" id="wizard">
        		<!-- SECTION 1 -->
            @csrf
                <h2></h2>
                <section>
            <div class="inner">
						<div class="image-holder">
							<img src="images/form-wizard-1.jpg" alt="">
						</div>
						<div class="form-content" >
							<div class="form-header">
								<h3>Upload Files To Cloud Servers</h3>
							</div>
							<p>Please fill Amzon S3 bucket details</p>
							<div class="form-row">
								<div class="form-holder">
									<input type="text" name="bucket_name" id="bucket_name"  required placeholder="Bucket Name" class="form-control" >
								</div>

							</div>
							<div class="form-row">
								<div class="form-holder">
									<input type="text" name="bucket_key" id="bucket_key"  required placeholder="I Am Key" class="form-control">
								</div>
							</div>
							<div class="form-row">
								<div class="form-holder">
									<input type="text" name="bucket_skey" id="bucket_skey"  required placeholder="I Am Secret Key" class="form-control">
								</div>
							</div>
							
						</div>
					</div>
                </section>

				<!-- SECTION 2 -->
                <h2></h2>
                <section>
            <div class="inner">
						<div class="image-holder">
							<img src="images/form-wizard-1.jpg" alt="">
						</div>
						<div class="form-content" >
							<div class="form-header">
								<h3>Upload Files To Cloud Servers</h3>
							</div>
							<p>Please fill Microsoft Azure container details</p>
							<div class="form-row">
								<div class="form-holder">
									<input type="text" name="azureStorage" id="azureStorage"  required placeholder="Azure Storage Account" class="form-control">
								</div>

							</div>
							<div class="form-row">
								<div class="form-holder">
									<input type="text" name="azureKey" id="azureKey"  required placeholder="Azure Storage Key" class="form-control">
								</div>
							</div>
							<div class="form-row">
								<div class="form-holder">
									<input type="text" name="azureContainer" id="azureContainer"  required placeholder="AZURE STORAGE CONTAINER" class="form-control">
								</div>
							</div>
							
						</div>
					</div>
                </section>

                <!-- SECTION 2 -->
                <h2></h2>
                <section>
            <div class="inner">
						<div class="image-holder">
							<img src="images/form-wizard-1.jpg" alt="">
						</div>
						<div class="form-content" >
							<div class="form-header">
								<h3>Upload Files To Cloud Servers</h3>
							</div>
							<p>Please fill Microsoft Azure container details</p>
							<div class="form-row">
								<div class="form-holder">
                <input name="userfile" id="userfile" type="file" value="Select HTML File" required  class="form-control" />
									
								</div>

							</div>
							<div class="form-row">
								<div class="form-holder">
                <input type="submit" value="Upload HTML File"   />
									
								</div>
							</div>
							
						</div>
					</div>
                </section>

            </form>
		</div>


@endsection
