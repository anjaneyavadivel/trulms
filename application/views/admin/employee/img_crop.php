<?php $this->load->view('admin/sidebar')?>
<!-- =================================================
                ================= RIGHTBAR Content ===================
                ================================================== -->
<!--/ RIGHTBAR Content -->
</div>

            <!-- ====================================================
            ================= CONTENT ===============================
            ===================================================== -->
            <section id="content">

                <div class="page page-forms-imgcrop">

                    <div class="pageheader">

                        <h2>Image Crop <span>// You can place subtitle here</span></h2>

                        <div class="page-bar">

                            <ul class="page-breadcrumb">
                                <li>
                                    <a href="index.html"><i class="fa fa-home"></i> Minovate</a>
                                </li>
                                <li>
                                    <a href="#">Form Stuff</a>
                                </li>
                                <li>
                                    <a href="form-imgcrop.html">Image Crop</a>
                                </li>
                            </ul>
                            
                        </div>

                    </div>


                    <!-- row -->
                    <div class="row">
                        <!-- col -->
                        <div class="col-md-12">
 <?php $this->load->view('admin/msg')?>
                            <!-- tile -->
                            <section class="tile tile-simple">

                              <!-- tile body -->
                              <div class="tile-body">

                                  <div class="row">
                                      <div class="col-md-6">
                                          <!-- <h3 class="page-header">Demo:</h3> -->
                                          <div class="img-container mb-10">
                                              <img src="<?=base_url()?>uploads/photo/baby.jpg" class="img-responsive" alt="Picture">
                                          </div>
                                      </div>

                                      <div class="col-md-4">
                                          <!-- <h3 class="page-header">Preview:</h3> -->
                                          <div class="docs-preview clearfix">
                                              <div class="img-preview preview-lg"></div>
                                              <div class="img-preview preview-md"></div>
                                              <div class="img-preview preview-sm"></div>
                                              <div class="img-preview preview-xs"></div>
                                          </div>

                                          <!-- <h3 class="page-header">Data:</h3> -->
                                          <div class="docs-data">
                                              <div class="input-group">
                                                  <label class="input-group-addon" for="dataX">X</label>
                                                  <input class="form-control" id="dataX" type="text" placeholder="x">
                                                  <span class="input-group-addon">px</span>
                                              </div>
                                              <div class="input-group mt-10">
                                                  <label class="input-group-addon" for="dataY">Y</label>
                                                  <input class="form-control" id="dataY" type="text" placeholder="y">
                                                  <span class="input-group-addon">px</span>
                                              </div>
                                              <div class="input-group mt-10">
                                                  <label class="input-group-addon" for="dataWidth">Width</label>
                                                  <input class="form-control" id="dataWidth" type="text" placeholder="width">
                                                  <span class="input-group-addon">px</span>
                                              </div>
                                              <div class="input-group mt-10">
                                                  <label class="input-group-addon" for="dataHeight">Height</label>
                                                  <input class="form-control" id="dataHeight" type="text" placeholder="height">
                                                  <span class="input-group-addon">px</span>
                                              </div>
                                              <div class="input-group mt-10">
                                                  <label class="input-group-addon" for="dataRotate">Rotate</label>
                                                  <input class="form-control" id="dataRotate" type="text" placeholder="rotate">
                                                  <span class="input-group-addon">deg</span>
                                              </div>
                                          </div>
                                      </div>

                                  </div>

                                  <div class="row">
                                      <div class="col-md-9 docs-buttons">
                                          <!-- <h3 class="page-header">Toolbar:</h3> -->
                                          <div class="btn-group mb-10">
                                              <button class="btn btn-primary" data-method="setDragMode" data-option="move" type="button" title="Move">
                                                  <span class="docs-tooltip" data-toggle="tooltip" title="$().cropper(&quot;setDragMode&quot;, &quot;move&quot;)">
                                                      <span class="fa fa-arrows"></span>
                                                  </span>
                                              </button>
                                              <button class="btn btn-primary" data-method="setDragMode" data-option="crop" type="button" title="Crop">
                                                  <span class="docs-tooltip" data-toggle="tooltip" title="$().cropper(&quot;setDragMode&quot;, &quot;crop&quot;)">
                                                      <span class="fa fa-crop"></span>
                                                  </span>
                                              </button>
                                              <button class="btn btn-primary" data-method="zoom" data-option="0.1" type="button" title="Zoom In">
                                                <span class="docs-tooltip" data-toggle="tooltip" title="$().cropper(&quot;zoom&quot;, 0.1)">
                                                    <span class="fa fa-search-plus"></span>
                                                </span>
                                              </button>
                                              <button class="btn btn-primary" data-method="zoom" data-option="-0.1" type="button" title="Zoom Out">
                                                    <span class="docs-tooltip" data-toggle="tooltip" title="$().cropper(&quot;zoom&quot;, -0.1)">
                                                      <span class="fa fa-search-minus"></span>
                                                    </span>
                                              </button>
                                              <button class="btn btn-primary" data-method="rotate" data-option="-45" type="button" title="Rotate Left">
                                                    <span class="docs-tooltip" data-toggle="tooltip" title="$().cropper(&quot;rotate&quot;, -45)">
                                                      <span class="fa fa-rotate-left"></span>
                                                    </span>
                                              </button>
                                              <button class="btn btn-primary" data-method="rotate" data-option="45" type="button" title="Rotate Right">
                                                    <span class="docs-tooltip" data-toggle="tooltip" title="$().cropper(&quot;rotate&quot;, 45)">
                                                      <span class="fa fa-rotate-right"></span>
                                                    </span>
                                              </button>
                                          </div>

                                          <div class="btn-group mb-10">
                                              <button class="btn btn-primary" data-method="crop" type="button" title="Crop">
                                                <span class="docs-tooltip" data-toggle="tooltip" title="$().cropper(&quot;crop&quot;)">
                                                  <span class="fa fa-check"></span>
                                                </span>
                                              </button>
                                              <button class="btn btn-primary" data-method="clear" type="button" title="Clear">
                                                <span class="docs-tooltip" data-toggle="tooltip" title="$().cropper(&quot;clear&quot;)">
                                                  <span class="fa fa-times"></span>
                                                </span>
                                              </button>
                                              <button class="btn btn-primary" data-method="disable" type="button" title="Disable">
                                                <span class="docs-tooltip" data-toggle="tooltip" title="$().cropper(&quot;disable&quot;)">
                                                  <span class="fa fa-lock"></span>
                                                </span>
                                              </button>
                                              <button class="btn btn-primary" data-method="enable" type="button" title="Enable">
                                                <span class="docs-tooltip" data-toggle="tooltip" title="$().cropper(&quot;enable&quot;)">
                                                  <span class="fa fa-unlock"></span>
                                                </span>
                                              </button>
                                              <button class="btn btn-primary" data-method="reset" type="button" title="Reset">
                                                <span class="docs-tooltip" data-toggle="tooltip" title="$().cropper(&quot;reset&quot;)">
                                                  <span class="fa fa-refresh"></span>
                                                </span>
                                              </button>
                                              <label class="btn btn-primary btn-upload" for="inputImage" title="Upload image file">
                                                  <input class="sr-only" id="inputImage" name="file" type="file" accept="image/*">
                                                    <span class="docs-tooltip" data-toggle="tooltip" title="Import image with Blob URLs">
                                                      <span class="fa fa-upload"></span>
                                                    </span>
                                              </label>
                                              <button class="btn btn-primary" data-method="destroy" type="button" title="Destroy">
                                                <span class="docs-tooltip" data-toggle="tooltip" title="$().cropper(&quot;destroy&quot;)">
                                                  <span class="fa fa-power-off"></span>
                                                </span>
                                              </button>
                                          </div>

                                          <div class="btn-group btn-group-crop mb-10">
                                              <button class="btn btn-primary" data-method="getCroppedCanvas" type="button">
                                                <span class="docs-tooltip" data-toggle="tooltip" title="$().cropper(&quot;getCroppedCanvas&quot;)">
                                                  Get Cropped Canvas
                                                </span>
                                              </button>
                                              <button class="btn btn-primary" data-method="getCroppedCanvas" data-option="{ &quot;width&quot;: 160, &quot;height&quot;: 90 }" type="button">
                                                <span class="docs-tooltip" data-toggle="tooltip" title="$().cropper(&quot;getCroppedCanvas&quot;, { width: 160, height: 90 })">
                                                  160&times;90
                                                </span>
                                              </button>
                                              <button class="btn btn-primary" data-method="getCroppedCanvas" data-option="{ &quot;width&quot;: 320, &quot;height&quot;: 180 }" type="button">
                                                <span class="docs-tooltip" data-toggle="tooltip" title="$().cropper(&quot;getCroppedCanvas&quot;, { width: 320, height: 180 })">
                                                  320&times;180
                                                </span>
                                              </button>
                                          </div>

                                          <!-- Show the cropped image in modal -->
                                          <div class="modal fade docs-cropped" id="getCroppedCanvasModal" aria-hidden="true" aria-labelledby="getCroppedCanvasTitle" role="dialog" tabindex="-1">
                                              <div class="modal-dialog">
                                                  <div class="modal-content">
                                                      <div class="modal-header">
                                                          <button class="close" data-dismiss="modal" type="button" aria-hidden="true">&times;</button>
                                                          <h4 class="modal-title" id="getCroppedCanvasTitle">Cropped</h4>
                                                      </div>
                                                      <div class="modal-body"></div>
                                                      <!-- <div class="modal-footer">
                                                        <button class="btn btn-primary" data-dismiss="modal" type="button">Close</button>
                                                      </div> -->
                                                  </div>
                                              </div>
                                          </div><!-- /.modal -->

                                          <div class="btn-group mb-10">
                                              <button class="btn btn-primary" data-method="getData" data-option="" data-target="#putData" type="button">
                                                  <span class="docs-tooltip" data-toggle="tooltip" title="$().cropper(&quot;getData&quot;)">
                                                    Get Data
                                                  </span>
                                              </button>
                                              <button class="btn btn-primary" data-method="setData" data-target="#putData" type="button">
                                                  <span class="docs-tooltip" data-toggle="tooltip" title="$().cropper(&quot;setData&quot;, data)">
                                                    Set Data
                                                  </span>
                                              </button>
                                              <button class="btn btn-primary" data-method="getContainerData" data-option="" data-target="#putData" type="button">
                                                  <span class="docs-tooltip" data-toggle="tooltip" title="$().cropper(&quot;getContainerData&quot;)">
                                                    Get Container Data
                                                  </span>
                                              </button>
                                              <button class="btn btn-primary" data-method="getImageData" data-option="" data-target="#putData" type="button">
                                                  <span class="docs-tooltip" data-toggle="tooltip" title="$().cropper(&quot;getImageData&quot;)">
                                                    Get Image Data
                                                  </span>
                                              </button>
                                              <button class="btn btn-primary" data-method="getCanvasData" data-option="" data-target="#putData" type="button">
                                                  <span class="docs-tooltip" data-toggle="tooltip" title="$().cropper(&quot;getCanvasData&quot;)">
                                                    Get Canvas Data
                                                  </span>
                                              </button>
                                              <button class="btn btn-primary" data-method="setCanvasData" data-target="#putData" type="button">
                                                  <span class="docs-tooltip" data-toggle="tooltip" title="$().cropper(&quot;setCanvasData&quot;, data)">
                                                    Set Canvas Data
                                                  </span>
                                              </button>
                                              <button class="btn btn-primary" data-method="getCropBoxData" data-option="" data-target="#putData" type="button">
                                                  <span class="docs-tooltip" data-toggle="tooltip" title="$().cropper(&quot;getCropBoxData&quot;)">
                                                    Get Crop Box Data
                                                  </span>
                                              </button>
                                              <button class="btn btn-primary" data-method="setCropBoxData" data-target="#putData" type="button">
                                                  <span class="docs-tooltip" data-toggle="tooltip" title="$().cropper(&quot;setCropBoxData&quot;, data)">
                                                    Set Crop Box Data
                                                  </span>
                                              </button>
                                          </div>
                                         

                                      </div><!-- /.docs-buttons -->

                                      <div class="col-md-3 docs-toggles">
                                          <!-- <h3 class="page-header">Toggles:</h3> -->
                                          <div class="btn-group btn-group-justified" data-toggle="buttons">
                                              <label class="btn btn-primary active" data-method="setAspectRatio" data-option="1.7777777777777777" title="Set Aspect Ratio">
                                                  <input class="sr-only" id="aspestRatio1" name="aspestRatio" value="1.7777777777777777" type="radio">
                                                    <span class="docs-tooltip" data-toggle="tooltip" title="$().cropper(&quot;setAspectRatio&quot;, 16 / 9)">
                                                      16:9
                                                    </span>
                                              </label>
                                              <label class="btn btn-primary" data-method="setAspectRatio" data-option="1.3333333333333333" title="Set Aspect Ratio">
                                                  <input class="sr-only" id="aspestRatio2" name="aspestRatio" value="1.3333333333333333" type="radio">
                                                    <span class="docs-tooltip" data-toggle="tooltip" title="$().cropper(&quot;setAspectRatio&quot;, 4 / 3)">
                                                      4:3
                                                    </span>
                                              </label>
                                              <label class="btn btn-primary" data-method="setAspectRatio" data-option="1" title="Set Aspect Ratio">
                                                  <input class="sr-only" id="aspestRatio3" name="aspestRatio" value="1" type="radio">
                                                    <span class="docs-tooltip" data-toggle="tooltip" title="$().cropper(&quot;setAspectRatio&quot;, 1 / 1)">
                                                      1:1
                                                    </span>
                                              </label>
                                              <label class="btn btn-primary" data-method="setAspectRatio" data-option="0.6666666666666666" title="Set Aspect Ratio">
                                                  <input class="sr-only" id="aspestRatio4" name="aspestRatio" value="0.6666666666666666" type="radio">
                                                    <span class="docs-tooltip" data-toggle="tooltip" title="$().cropper(&quot;setAspectRatio&quot;, 2 / 3)">
                                                      2:3
                                                    </span>
                                              </label>
                                              <label class="btn btn-primary" data-method="setAspectRatio" data-option="NaN" title="Set Aspect Ratio">
                                                  <input class="sr-only" id="aspestRatio5" name="aspestRatio" value="NaN" type="radio">
                                                    <span class="docs-tooltip" data-toggle="tooltip" title="$().cropper(&quot;setAspectRatio&quot;, NaN)">
                                                      Free
                                                    </span>
                                              </label>
                                          </div>

                                          <div class="dropdown dropup docs-options mt-10">
                                              <button class="btn btn-primary btn-block dropdown-toggle" id="toggleOptions" type="button" data-toggle="dropdown" aria-expanded="true">
                                                  Toggle Options
                                                  <span class="caret"></span>
                                              </button>
                                              <ul class="dropdown-menu p-10" role="menu" aria-labelledby="toggleOptions">
                                                  <li role="presentation">
                                                      <label class="checkbox-inline">
                                                          <input type="checkbox" name="option" value="strict" checked>
                                                          strict
                                                      </label>
                                                  </li>
                                                  <li role="presentation">
                                                      <label class="checkbox-inline">
                                                          <input type="checkbox" name="option" value="responsive" checked>
                                                          responsive
                                                      </label>
                                                  </li>
                                                  <li role="presentation">
                                                      <label class="checkbox-inline">
                                                          <input type="checkbox" name="option" value="checkImageOrigin" checked>
                                                          checkImageOrigin
                                                      </label>
                                                  </li>

                                                  <li role="presentation">
                                                      <label class="checkbox-inline">
                                                          <input type="checkbox" name="option" value="modal" checked>
                                                          modal
                                                      </label>
                                                  </li>
                                                  <li role="presentation">
                                                      <label class="checkbox-inline">
                                                          <input type="checkbox" name="option" value="guides" checked>
                                                          guides
                                                      </label>
                                                  </li>
                                                  <li role="presentation">
                                                      <label class="checkbox-inline">
                                                          <input type="checkbox" name="option" value="highlight" checked>
                                                          highlight
                                                      </label>
                                                  </li>
                                                  <li role="presentation">
                                                      <label class="checkbox-inline">
                                                          <input type="checkbox" name="option" value="background" checked>
                                                          background
                                                      </label>
                                                  </li>

                                                  <li role="presentation">
                                                      <label class="checkbox-inline">
                                                          <input type="checkbox" name="option" value="autoCrop" checked>
                                                          autoCrop
                                                      </label>
                                                  </li>
                                                  <li role="presentation">
                                                      <label class="checkbox-inline">
                                                          <input type="checkbox" name="option" value="dragCrop" checked>
                                                          dragCrop
                                                      </label>
                                                  </li>
                                                  <li role="presentation">
                                                      <label class="checkbox-inline">
                                                          <input type="checkbox" name="option" value="movable" checked>
                                                          movable
                                                      </label>
                                                  </li>
                                                  <li role="presentation">
                                                      <label class="checkbox-inline">
                                                          <input type="checkbox" name="option" value="resizable" checked>
                                                          resizable
                                                      </label>
                                                  </li>
                                                  <li role="presentation">
                                                      <label class="checkbox-inline">
                                                          <input type="checkbox" name="option" value="rotatable" checked>
                                                          rotatable
                                                      </label>
                                                  </li>
                                                  <li role="presentation">
                                                      <label class="checkbox-inline">
                                                          <input type="checkbox" name="option" value="zoomable" checked>
                                                          zoomable
                                                      </label>
                                                  </li>
                                                  <li role="presentation">
                                                      <label class="checkbox-inline">
                                                          <input type="checkbox" name="option" value="touchDragZoom" checked>
                                                          touchDragZoom
                                                      </label>
                                                  </li>
                                                  <li role="presentation">
                                                      <label class="checkbox-inline">
                                                          <input type="checkbox" name="option" value="mouseWheelZoom" checked>
                                                          mouseWheelZoom
                                                      </label>
                                                  </li>
                                              </ul>
                                          </div><!-- /.dropdown -->
                                      </div><!-- /.docs-toggles -->
                                  </div>

 <?=form_open_multipart(base_url().'profile_crop',array('id'=>'edit_employee','role'=>'form'));?>
 <input class="form-control" id="putData" name="putData" type="text" placeholder="Get data to here or set data with this value">
   <input type="submit" class="btn bg-greensea" id="add_form" value="Update" >
    <?php echo form_close(); ?> 
                              </div>
                              <!-- /tile body -->

                            </section>
                            <!-- /tile -->

                        </div>
                        <!-- /col -->
                    </div>
                    <!-- /row -->


                </div>
                
            </section>
            <!--/ CONTENT -->






        </div>
        <!--/ Application Content -->


        <!-- ============================================
        ============== Vendor JavaScripts ===============
        ============================================= -->
        <script src="<?=base_url()?>https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="<?=base_url()?>assets/js/vendor/jquery/jquery-1.11.2.min.js"><\/script>')</script>

        <script src="<?=base_url()?>assets/js/vendor/bootstrap/bootstrap.min.js"></script>

        <script src="<?=base_url()?>assets/js/vendor/jRespond/jRespond.min.js"></script>

        <script src="<?=base_url()?>assets/js/vendor/sparkline/jquery.sparkline.min.js"></script>

        <script src="<?=base_url()?>assets/js/vendor/slimscroll/jquery.slimscroll.min.js"></script>

        <script src="<?=base_url()?>assets/js/vendor/animsition/js/jquery.animsition.min.js"></script>

        <script src="<?=base_url()?>assets/js/vendor/screenfull/screenfull.min.js"></script>

        <script src="<?=base_url()?>assets/js/vendor/filestyle/bootstrap-filestyle.min.js"></script>

        <script src="<?=base_url()?>assets/js/vendor/cropper/cropper.min.js"></script>
        <!--/ vendor javascripts -->




        <!-- ============================================
        ============== Custom JavaScripts ===============
        ============================================= -->
        <script src="<?=base_url()?>assets/js/main.js"></script>
        <!--/ custom javascripts -->






        <!-- ===============================================
        ============== Page Specific Scripts ===============
        ================================================ -->
        <script>
            $(window).load(function(){
                $(function () {

                    'use strict';

                    var console = window.console || { log: function () {} },
                            $alert = $('.docs-alert'),
                            $message = $alert.find('.message'),
                            showMessage = function (message, type) {
                                $message.text(message);

                                if (type) {
                                    $message.addClass(type);
                                }

                                $alert.fadeIn();

                                setTimeout(function () {
                                    $alert.fadeOut();
                                }, 3000);
                            };

                    // Demo
                    // -------------------------------------------------------------------------

                    (function () {
                        var $image = $('.img-container > img'),
                                $dataX = $('#dataX'),
                                $dataY = $('#dataY'),
                                $dataHeight = $('#dataHeight'),
                                $dataWidth = $('#dataWidth'),
                                $dataRotate = $('#dataRotate'),
                                options = {
                                    // data: {
                                    //   x: 420,
                                    //   y: 60,
                                    //   width: 640,
                                    //   height: 360
                                    // },
                                    // strict: false,
                                    // responsive: false,
                                    // checkImageOrigin: false

                                    // modal: false,
                                    // guides: false,
                                    // highlight: false,
                                    // background: false,

                                    // autoCrop: false,
                                    // autoCropArea: 0.5,
                                    // dragCrop: false,
                                    // movable: false,
                                    // resizable: false,
                                    // rotatable: false,
                                    // zoomable: false,
                                    // touchDragZoom: false,
                                    // mouseWheelZoom: false,

                                    // minCanvasWidth: 320,
                                    // minCanvasHeight: 180,
                                    // minCropBoxWidth: 160,
                                    // minCropBoxHeight: 90,
                                    // minContainerWidth: 320,
                                    // minContainerHeight: 180,

                                    // build: null,
                                    // built: null,
                                    // dragstart: null,
                                    // dragmove: null,
                                    // dragend: null,
                                    // zoomin: null,
                                    // zoomout: null,

                                    aspectRatio: 16 / 9,
                                    preview: '.img-preview',
                                    crop: function (data) {
                                        $dataX.val(Math.round(data.x));
                                        $dataY.val(Math.round(data.y));
                                        $dataHeight.val(Math.round(data.height));
                                        $dataWidth.val(Math.round(data.width));
                                        $dataRotate.val(Math.round(data.rotate));
                                    }
                                };

                        $image.on({
                            'build.cropper': function (e) {
                                console.log(e.type);
                            },
                            'built.cropper': function (e) {
                                console.log(e.type);
                            },
                            'dragstart.cropper': function (e) {
                                console.log(e.type, e.dragType);
                            },
                            'dragmove.cropper': function (e) {
                                console.log(e.type, e.dragType);
                            },
                            'dragend.cropper': function (e) {
                                console.log(e.type, e.dragType);
                            },
                            'zoomin.cropper': function (e) {
                                console.log(e.type);
                            },
                            'zoomout.cropper': function (e) {
                                console.log(e.type);
                            }
                        }).cropper(options);


                        // Methods
                        $(document.body).on('click', '[data-method]', function () {
                            var data = $(this).data(),
                                    $target,
                                    result;

                            if (data.method) {
                                data = $.extend({}, data); // Clone a new one

                                if (typeof data.target !== 'undefined') {
                                    $target = $(data.target);

                                    if (typeof data.option === 'undefined') {
                                        try {
                                            data.option = JSON.parse($target.val());
                                        } catch (e) {
                                            console.log(e.message);
                                        }
                                    }
                                }

                                result = $image.cropper(data.method, data.option);

                                if (data.method === 'getCroppedCanvas') {
                                    $('#getCroppedCanvasModal').modal().find('.modal-body').html(result);
                                }

                                if ($.isPlainObject(result) && $target) {
                                    try {
                                        $target.val(JSON.stringify(result));
                                    } catch (e) {
                                        console.log(e.message);
                                    }
                                }

                            }
                        }).on('keydown', function (e) {

                            switch (e.which) {
                                case 37:
                                    e.preventDefault();
                                    $image.cropper('move', -1, 0);
                                    break;

                                case 38:
                                    e.preventDefault();
                                    $image.cropper('move', 0, -1);
                                    break;

                                case 39:
                                    e.preventDefault();
                                    $image.cropper('move', 1, 0);
                                    break;

                                case 40:
                                    e.preventDefault();
                                    $image.cropper('move', 0, 1);
                                    break;
                            }

                        });


                        // Import image
                        var $inputImage = $('#inputImage'),
                                URL = window.URL || window.webkitURL,
                                blobURL;

                        if (URL) {
                            $inputImage.change(function () {
                                var files = this.files,
                                        file;

                                if (files && files.length) {
                                    file = files[0];

                                    if (/^image\/\w+$/.test(file.type)) {
                                        blobURL = URL.createObjectURL(file);
                                        $image.one('built.cropper', function () {
                                            URL.revokeObjectURL(blobURL); // Revoke when load complete
                                        }).cropper('reset').cropper('replace', blobURL);
                                        $inputImage.val('');
                                    } else {
                                        showMessage('Please choose an image file.');
                                    }
                                }
                            });
                        } else {
                            $inputImage.parent().remove();
                        }


                        // Options
                        $('.docs-options :checkbox').on('change', function () {
                            var $this = $(this);

                            options[$this.val()] = $this.prop('checked');
                            $image.cropper('destroy').cropper(options);
                        });


                        // Tooltips
                        $('[data-toggle="tooltip"]').tooltip();

                    }());

                });
            });
        </script>
        <!--/ Page Specific Scripts -->



    </body>
</html>
