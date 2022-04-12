@extends('layouts.master')

@section('content')
<script src="{{ asset('js/qr-code-styling.js') }}"></script>


@if($qr == 0)
	<form action="{{ route('codigoqrs.store') }}" method="POST" enctype="multipart/form-data">
@else		
	<form action="{{ route('codigoqrs.update') }}" method="POST" enctype="multipart/form-data">
	
	<input type="hidden" value="{{ $cod->id}}" name="id_qr">
@endif	
	@csrf
		<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg py-6 px-4">
				<div class="col-md-12 " style="padding-top:5%">	
					<div class="row">	
						<div class="col-md-6">	
							<label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2" for="grid-password">
								{{__('messages.text_to_convert') }}	
							</label><br>
							<input @if($qr == 1)onkeyup="updateQrDataU();" @else onkeyup="updateQrData();" @endif  class="w-100 appearance-none block  bg-grey-lighter text-grey-darker border border-grey-lighter rounded py-3 px-4 mb-3" id="url" type="text" placeholder="{{$url}}" name="url"   @if($qr == 1)value="{{ $cod->url }}"@endif>
						</div>
						<div class="col-md-6">
							<label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2" for="typedots">
								{{__('messages.type_shapes') }}	
							</label><br>
							<select @if($qr == 1)onchange="updateQrTypeU();" @else onchange="updateQrType();" @endif   name="typedots" id="typedots" class="appearance-none block w-100 bg-grey-lighter text-grey-darker border border-grey-lighter rounded py-3 px-4 mb-3">
							  <option value="square" @if($qr == 1 && $cod->typedots == "square") selected @endif >Square</option>
							  <option value="rounded" @if($qr == 1 && $cod->typedots == "rounded") selected @endif >Rounded</option>
							  <option value="dots" @if($qr == 1 && $cod->typedots == "dots") selected @endif >Dots</option>
							  <option value="classy" @if($qr == 1 && $cod->typedots == "classy") selected @endif >Classy</option>
							  <option value="classy-rounded" @if($qr == 1 && $cod->typedots == "classy-rounded") selected @endif >Classy Rounded</option>
							  <option value="extra-rounded" @if($qr == 1 && $cod->typedots == "extra-rounded") selected @endif >Extra Rounded</option>
							  
							 
							</select>

						
						</div>
					</div>
					<div class="row">	
						<div class="col-md-6">	
							<label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2" for="width">
							{{__('messages.width') }}	
							</label><br>
							<input  @if($qr == 1)onchange="updateQrWidthU();" @else onchange="updateQrWidth();" @endif  class="appearance-none block w-100 bg-grey-lighter text-grey-darker border border-red rounded py-3 px-4 mb-3" id="width" type="text" placeholder="Jane" name="width" @if($qr == 1)value="{{ $cod->width }}"@else value="300" @endif>
						
						</div>
						<div class="col-md-6">	
							<label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2" for="height">
								{{__('messages.height') }}
							</label><br>	
							<input  @if($qr == 1)onchange="updateQrHeightU();" @else onchange="updateQrHeight();" @endif  class="appearance-none block w-100 bg-grey-lighter text-grey-darker border border-grey-lighter rounded py-3 px-4 mb-3" id="height" type="text" placeholder="Doe" name="height"  @if($qr == 1)value="{{ $cod->height }}"@else value="300" @endif>
							
						</div>
					</div>
					<div class="row" style="margin-bottom: 30px;">	
						<div class="col-md-6">	
							<label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2" for="background">
							<!--Color de Fondo--> {{__('messages.background_color') }}
							</label><br><br>
							<span class="block color-picker py-3 border border-gray-500 rounded mb-3 px-4 text-center mx-auto">
								<input @if($qr == 1)onchange="updateQrBackU();" @else onchange="updateQrBack();" @endif   class="appearance-none block w-50" id="background" type="color" placeholder="Doe" name="background"  @if($qr == 1)value="{{ $cod->background }}"@else value="#e9ebee" @endif >
							</span>
						
						</div>
						<div class="col-md-6">	
							<label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2" for="color">
							<!--Color del Codigo QR-->{{__('messages.qr_color') }}
							</label><br><br>
							<span class="block color-picker py-3 border border-gray-500 rounded mb-3 px-4 text-center mx-auto">
								<input @if($qr == 1)onchange="updateQrColorU();" @else onchange="updateQrColor();" @endif   class="appearance-none block w-50"  id="color" type="color"  name="color"  @if($qr == 1)value="{{ $cod->color }}"@else value="#4267b2" @endif>
							</span>
						</div>
					</div>
					<div class="row">	
						<div class="col-md-12">	
							<label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2" for="image">
								<!--Imagen Central del QR-->{{__('messages.qr_image') }}
							</label>
							<input @if($qr == 1)onchange="updateQrImgU();"  @else onchange="updateQrImg();"  @endif    type="file"  name="image" id="image" accept="image/*" class="appearance-none block w-100 bg-grey-lighter text-grey-darker border border-gray-500 rounded py-3 px-4" id="grid-background" type="text" /><br>
							
							<input class="appearance-none block w-50" type="hidden" id="imageUp"   name="imageUp"  @if($qr == 1)value="{{ $cod->image }}"@else value="" @endif>
							
							
							<input @if($qr == 1)onchange="updateQrImageRemU();"  @else onchange="updateQrImageRem();"  @endif   type="checkbox" id="checkbox" name="checkbox" class="form-checkbox h-5 w-5 text-gray-600"><span class="ml-2 text-gray-700"><!--Elimine Imagen-->{{__('messages.delete_image') }}</span>
						</div>
					</div>
				</div>
			</div>
		</div>

	
	
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg py-6 px-4">
               
	
				<div class="-mx-3 md:flex mb-6">
				
				
					<div class="md:w-1/2 px-3 text-center mx-auto">
					@if($qr == 0)
						<div id="canvas"  class="mx-auto"></div>
						
						<h3>USA TU QR DONDE QUIERAS</h3>
						<button  onclick="download();" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded inline-flex items-center mt-6">
						  <svg style="width: 1rem;" class="fill-current w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M13 8V2H7v6H2l8 8 8-8h-5zM0 18h20v2H0v-2z"/></svg>
						  <span><!--Download-->{{__('messages.btn_3') }}</span>
						</button>
						
						
						
					@else
						<div id="canvasup"  class=""></div>
						
						<h3>USA TU QR DONDE QUIERAS</h3>
						
						<button  onclick="downloadUp();" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded inline-flex items-center mt-6">
						  <svg style="width: 1rem;" class="fill-current w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M13 8V2H7v6H2l8 8 8-8h-5zM0 18h20v2H0v-2z"/></svg>
						  <span><!--Download-->{{__('messages.btn_3') }}</span>
						</button>
					@endif
						

					</div>
					
					
					
		<div style="text-align: center; margin-top: 12px">
				<button type="submit" class="btn btn-primary" id="sub-form"><!--Guardar-->{{__('messages.btn_4') }}</button>	
       </div>
					
				</div>

            </div>
		 </div>	

		


		
    </div>
</form>
<style type="text/css">


canvas{
	max-width:400px;
	margin-left:auto;
	margin-right:auto;
	width: -webkit-fill-available;	
    padding:4%;
}

@media (max-width: 450px) {
  canvas{
	max-width:300px;
	
  }
}
</style>
<script type="text/javascript">


	  url = document.getElementById("url");
	  width = document.getElementById("width");
	  height = document.getElementById("height");
	  color = document.getElementById("color");
	  typedots = document.getElementById("typedots");
	  background = document.getElementById("background");	  
	  qrImage = document.getElementById('image');	
	  
	  qrImageUp = document.getElementById('imageUp');	
	
/*update*/	 
	if(qrImageUp.value == ""){
				image="";
			}
			else{
				path="/storage/uploads/";
				img = qrImageUp.value;	
				image = path+img;
			}


 const qrCodeUp = new QRCodeStyling({
        width: 300,
        height: 300,
        data: url.value,
        image: image,
        dotsOptions: {
            color: color.value,
            type: typedots.value
        },
        backgroundOptions: {
            color: background.value,
        },	
        imageOptions: {
            crossOrigin: "anonymous",
            margin: 5
        },
	
    });
	
	
	const updateQrDataU = () => {
  newQrData = url.value;
  qrCodeUp.update({
    data: newQrData
  });
};

const updateQrImageRemU = () => {
	if (document.getElementById('checkbox').checked) {		
	  qrCodeUp.update({
		image: ""
	  });
	  
	  qrImageUp.value= "0";
    }
};


const updateQrWidthU = () => {
  newQrWidth = width.value;
  height.value = newQrWidth;
  qrCodeUp.update({
    width: newQrWidth,
    height: newQrWidth
  });
};


const updateQrHeightU = () => {
  newQrHeight = height.value;
  width.value = newQrHeight;
  qrCodeUp.update({
    height: newQrHeight,
	width: newQrHeight,
  });
};

const updateQrImgU = () => {
	const file = qrImage.files[0]; 
	const newQrImage = URL.createObjectURL(file); 
	file.src = newQrImage;

  qrCodeUp.update({
    image: newQrImage
  });
  
  document.getElementById("checkbox").checked = false;
};

const updateQrColorU = () => {
  newQrColor = color.value;
  qrCodeUp.update({
    dotsOptions: {
      color: newQrColor
    }
  });
};

const updateQrTypeU = () => {
  newQrType = typedots.value;
  qrCodeUp.update({
    dotsOptions: {
      type: newQrType
    }
  });
};

const updateQrBackU = () => {
  newQrBack = background.value;
  qrCodeUp.update({
    backgroundOptions: {
        color: newQrBack,
    },
  });
};

const downloadUp = () => {
	qrCodeUp.download();
}


	
	qrCodeUp.append(document.getElementById("canvasup"));
	
	
	
	
/*finupdate*/


			
	
/*store*/
    const qrCode = new QRCodeStyling({
        width: 300,
        height: 300,
        data: "https://www.facebook.com/",
        image: "https://upload.wikimedia.org/wikipedia/commons/5/51/Facebook_f_logo_%282019%29.svg",
        dotsOptions: {
            color: "#4267b2",
            type: "square"
        },
        backgroundOptions: {
            color: "#e9ebee",
        },	
        imageOptions: {
            crossOrigin: "anonymous",
            margin: 5
        },
	
    });




const updateQrData = () => {
  newQrData = url.value;
  qrCode.update({
    data: newQrData
  });
};

const updateQrImageRem = () => {
	if (document.getElementById('checkbox').checked) {		
	  qrCode.update({
		image: ""
	  });
    }
};


const updateQrWidth = () => {
  newQrWidth = width.value;
  height.value = newQrWidth;
  qrCode.update({
    width: newQrWidth,
    height: newQrWidth
  });
};


const updateQrHeight = () => {
  newQrHeight = height.value;
  width.value = newQrHeight;
  qrCode.update({
    height: newQrHeight,
	width: newQrHeight,
  });
};

const updateQrImg = () => {
	const file = qrImage.files[0]; 
	const newQrImage = URL.createObjectURL(file); 
	file.src = newQrImage;

  qrCode.update({
    image: newQrImage
  });
  
  document.getElementById("checkbox").checked = false;
};

const updateQrColor = () => {
  newQrColor = color.value;
  qrCode.update({
    dotsOptions: {
      color: newQrColor
    }
  });
};

const updateQrType = () => {
  newQrType = typedots.value;
  qrCode.update({
    dotsOptions: {
      type: newQrType
    }
  });
};

const updateQrBack = () => {
  newQrBack = background.value;
  qrCode.update({
    backgroundOptions: {
        color: newQrBack,
    },
  });
};

const download = () => {
	qrCode.download();
}

qrCode.append(document.getElementById("canvas"));
	/*fin-store*/
</script>
@endsection
