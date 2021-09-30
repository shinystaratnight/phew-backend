$(window).on("load", function() {
    "use strict";
    $("#preloader").delay(600).fadeOut();
    $("body").css("overflow-y", "scroll");
});

$(document).ready(function () {
    $('html').append('<div class="overlay-awady"></div>');
    "use strict";
    //  hamburger menu
    $('.menu-wrapper').on('click', function() {
        $('.menu-wrapper').addClass('hidden');
        $('.navbar-collapse').addClass('show');
        $('.overlay-awady').addClass('show');
        $('body').css("overflow-y", "hidden");

        // $('html').append('<div class="overlay-awady"></div>');

    });
    $('.overlay-awady').on('click', function () {
        $(this).removeClass('show');
        $('.menu-wrapper').removeClass('hidden');
        $('.navbar-collapse').removeClass('show');
        $('body').css("overflow-y", "scroll");

    });
    $('.close-menu').on('click', function() {
        $('.menu-wrapper').removeClass('hidden');
        $('.navbar-collapse').removeClass('show');
        $('.overlay-awady').removeClass('show');
        // $('.overlay-awady').remove();
        $('body').css("overflow-y", "scroll");
    });

    new WOW().init();

    // select
    $('.single-select').select2({
        dir: "rtl"
    });

    $('.dropdown-menu li').on('click', function() {
        var getValue = $(this).text();
        $(this).parent().parent().find(".dropdown-select").text(getValue);
        $(this).parent().parent().parent().parent().parent().parent().parent().find(".second-header").find(".page-header").find(".street-value").text("," + getValue);
    });

    // show password
    $('.show-pass').click(function() {
        if ($(this).find('.eye').attr('data-icon') == "eye-slash") {
            $(this).parent().find('input').attr('type', 'text');
            $(this).find('.eye').attr("data-icon", "eye");
        } else {
            $(this).parent().find('input').attr('type', 'password');
            $(this).find('.eye').attr("data-icon", "eye-slash");
        }
    });

    // fav icon
    $('.fav-icon').on('click', function(e) {
        $(this).toggleClass("liked");
        e.preventDefault();
    });


    // upload avatar
    $(function() {
        function maskImgs() {
            //$('.img-wrapper img').imagesLoaded({}, function() {
            $.each($('.img-wrapper img'), function(index, img) {
                var src = $(img).attr('src');
                var parent = $(img).parent();
                parent
                    .css('background', 'url(' + src + ') no-repeat center center')
                    .css('background-size', 'cover');
                $(img).remove();
            });
            //});
        }

        var preview = {
            init: function() {
                preview.setPreviewImg();
                preview.listenInput();
            },
            setPreviewImg: function(fileInput) {
                var path = $(fileInput).val();
                var uploadText = $(fileInput).siblings('.file-upload-text');

                if (!path) {
                    $(uploadText).val('');
                } else {
                    path = path.replace(/^C:\\fakepath\\/, "");
                    $(uploadText).val(path);

                    preview.showPreview(fileInput, path, uploadText);
                }
            },
            showPreview: function(fileInput, path, uploadText) {
                var file = $(fileInput)[0].files;

                if (file && file[0]) {
                    var reader = new FileReader();

                    reader.onload = function(e) {
                        var previewImg = $(fileInput).parents('.file-upload-wrapper').siblings('.preview');
                        var img = $(previewImg).find('img');

                        if (img.length == 0) {
                            $(previewImg).html('<img src="' + e.target.result + '" alt=""/>');
                        } else {
                            img.attr('src', e.target.result);
                        }

                        uploadText.val(path);
                        maskImgs();
                    }

                    reader.onloadstart = function() {
                        $(uploadText).val('uploading..');
                    }

                    reader.readAsDataURL(file[0]);
                }
            },
            listenInput: function() {
                $('.file-upload-native').on('change', function() {
                    preview.setPreviewImg(this);
                });
            }
        };
        preview.init();
    });
    var clicked = false;
    $(".check-all").on("click", function() {
        $(".check").prop("checked", !clicked);
        clicked = !clicked;
    });

    $('.editable-social').find("span").one('click', function(e) {
        e.preventDefault();
        $(this).addClass('open');
        $('.add-social').append('<div class="form-group d-flex">' +
            '<input type="text" class="form-control white-font w-border bg-grey w-radius" placeholder="ادخل الرابط الخاص بك" />' +
            '<span class="white-font w-border bg-grey w-radius remove-icon">' +
            '<i class="fas fa-times"></i>' +
            '</span>' +
            '</div>');

        // remove input
        $(".remove-icon").click(function() {
            $(this).closest(".add-social .form-group").fadeOut("slow", function() {
                $(this).closest(".add-social .form-group").remove();
            });
        });
    });

    // remove input
    $(".remove-icon").click(function() {
        $(this).closest("li").fadeOut("slow", function() {
            $(this).closest("li").remove();
        });
    });
    //add-city
    $('.add-city').on('click', function(e) {
        $('.insert-div').after(
            '<div class="output-city">' +
            '<div class="put-cit">' +
            $(".insert-div .form-control").val() +
            "</div>" +
            '<span class="remove-icon2">' +
            '<i class="fas fa-times"></i>' +
            '</span>' +
            '</div>'
        );

        // remove input
        $(".remove-icon2").click(function() {
            $(this).closest(".output-city").fadeOut("slow", function() {
                $(this).closest(".output-city").remove();
            });
        });
        $(".insert-div .form-control").val("");
    });

    var count = 0;

    $(function() {
        //        var name1 = "spee" + count,
        //        myLi = '<li class=' + name1 + '>' +
        //            "<i class='fa fa-minus'></i>" +
        //            "</li>";
        //        $("input[type=color]").change(function (e) {
        //            console.log(e.target.value);
        //            $(this).parent().before(myLi);
        //            $("." + name1).css("background-color", '' + e.target.value + '');
        //            count++;
        //            console.log(count);
        //        });

        $("input[type=color]").change(function(e) {
            console.log(e.target.value);
            $(this).parent().before("<li class='ex-col' style='background-color:" + e.target.value + "'>" +
                "<i class='fa fa-minus'></i>" +
                "</li>");

            //remove color

            $(".ex-col").click(function() {
                $(this).closest("li").remove();
            });

        });

        //remove color

        $(".add-color .ex-col").click(function() {
            $(this).closest("li").remove();
        });

    });

    $(".add-icon2").click(function() {

        $(this).before(
            "<li class='exsit'>" +
            "<i class='fa fa-minus'>" +
            "</i>" +
            "</li>"
        );

        //remove size

        $(".exsit").click(function() {
            $(this).remove();
        });

    });

    //remove size

    $(".exsit").click(function() {
        $(this).remove();
    });


    $('.imp-sett ').find(".use-add").on('click', function(e) {
        e.preventDefault();

        $(this).before(
            "<div class='sett-con4'>" +
            "<div class='right-not'>" +
            "<ul class='list-unstyled'>" +
            "<li>" +
            "<span>HOSSAM ALAHMADI</span>" +
            "<i class='fa fa-user-check'></i>" +
            "</li>" +
            "</ul>" +
            "</div>" +
            "<div class='left-not'>" +
            "<span class='rem-div'>" +
            "<i class='fa fa-user-times'></i>" +
            "</span>" +
            "</div>" +
            "</div>"
        );

        $(".rem-div").click(function() {
            $(this).closest(".sett-con4").remove();
        });

    });

    //remove set

    $(".rem-div").click(function() {

        $(this).closest(".sett-con4").remove();

    });

    // upload cover
    $(function() {
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('.imagePreview').css('background-image', 'url(' + e.target.result + ')');
                    $('.imagePreview').hide();
                    $('.imagePreview').fadeIn(650);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
        $(".imageUpload").change(function() {
            readURL(this);
        });
    });
    // upload profile image
    $(function() {
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('.imagePreview-profile').css('background-image', 'url(' + e.target.result + ')');
                    $('.imagePreview-profile').hide();
                    $('.imagePreview-profile').fadeIn(650);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
        $(".imageUpload-profile").change(function() {
            readURL(this);
        });
    });

    //test for iterating over child elements
    var langArray = [];
    $('.cities-options option').each(function() {
        var img = $(this).attr("data-thumbnail");
        var text = this.innerText;
        var value = $(this).val();
        var item = '<li class="dropdown-item white-font" value="' + text + '"><span class="country-name">' + text + '</span> <span class="country-value">' + value + '</span> <img src="' + img + '" alt="" value="' + value + '"/></li>';
        langArray.push(item);
    })

    $('#currencies-list').html(langArray);

    //Set the button value to the first el of the array
    $('.btn-select').html(langArray[0]);


    //change button stuff on click
    $('#currencies-list li').click(function() {
        var img = $(this).find('img').attr("src");
        var value = $(this).find('img').attr('value');
        var text = $(this).attr('value');
        var item = '<li><span class="country-name">' + text + '</span><span class="country-value">' + value + '</span> <img src="' + img + '" alt="" /></li>';
        $('.btn-select').html(item);
        $(".block").toggleClass('show');
    });

    $(".btn-select").click(function() {
        $(".block").toggleClass('show');
    });
    $(".navbar-toggler").click(function() {
        $(".container-map .main-menu").addClass("zindex3");
    });
    $("span.close-menu").click(function() {
        $(".container-map .main-menu").removeClass("zindex3");
    });
    // Activating the animation of the news bar
    var totalWidth = 0;

    $(".news-holder .news .new").each(function() {
        var oneWidth = $(this).outerWidth();
        totalWidth += oneWidth;
    });

    function newsBar() {
        var news = $(".news-holder .news"),
            actualWidth = totalWidth + ($(window).width() - (news.offset().left + news.outerWidth())),
            newsSpeed = (actualWidth / /* Here goes your speed with pixels */ 60) * 1000;

        $(".news-holder .news").animate({
            "right": -totalWidth
        }, newsSpeed, "linear", function() {
            $(".news-holder .news").css("right", "100%");
            newsBar();
        });

    }
    newsBar();

    $(".news-holder").on("mouseenter", function() {
        var that = $(this).find(".news").stop(true);
    });

    $(".news-holder").on("mouseleave", function() {
        newsBar();
    });

    $('.chooseFile').bind('change', function() {
        var filename = $(this).val();
        if (/^\s*$/.test(filename)) {
            $(this).parent().parent().removeClass('active');
            $(this).siblings(".file-select-name").text("No file chosen...");
        } else {
            $(this).parent().parent().addClass('active');
            $(this).siblings(".file-select-name").text(filename.replace("C:\\fakepath\\", ""));
        }
    });

    // //multi upload

    $(function() {
        $(document).ready(function() {
            var names = [];
            $('body').on('change', '.upload_btn', function(event) {
                $('#count_img, #size_img, #file_types').hide();
                var files = event.target.files;
                console.log(files.length);
                for (var i = 0; i < files.length; i++) {
                    var file = files[i];
                    names.push(file.size);
                    var max_count = 8;
                    if (names.length == max_count) {
                        $('#count_img').show();
                        $('#count_img_var').html(max_count);
                        $('#upload_btn').parent('.upload_btn').hide();
                    }
                    if (names.length > max_count) {
                        names.pop();
                        return false;
                    }
                    var fileType = file.type;
                    console.log(fileType);
                    if (fileType == 'image/png' || fileType == 'image/jpeg') {

                    } else {
                        $('#file_types').show();
                        return false;
                    }
                    var totalBytes = file.size;
                    var max_size = 5;
                    var max_bites = max_size * 1024 * 1024;
                    if (totalBytes > max_bites) {
                        $('#size_img').show();
                        $('#size_img_var').html(max_size + 'MB');
                        return false;
                    }
                    var picReader = new FileReader();
                    picReader.addEventListener("load", function(event) {
                        var picFile = event.target;
                        var picSize = event.total;
                        $("<div class='upload_item'><img src='" + picFile.result + "'" + " class='upload_img'/><a data-id='" + picSize + "' class='upload_del'>x</a></div>").insertAfter('#upload_btn_wrap');
                    });
                    picReader.readAsDataURL(file);
                }
                $('body').on('click', '.upload_del', function() {
                    $('#count_img, #size_img, #file_types').hide();
                    $(this).closest('.upload_item').remove();
                    $('#upload_btn').parent('.upload_btn').show();
                    $('#count_img').hide();
                    var removeItem = $(this).attr('data-id');
                    var yet = names.indexOf(removeItem);
                    names.splice(yet, 1);
                    console.log(names);
                });
            });
        });
    });



});
