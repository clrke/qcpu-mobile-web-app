$(document).on( "pagecreate", "#HomePage", function() {
    $( document ).on( "swipeleft swiperight", "#HomePage", function( e ) {
        // We check if there is no open panel on the page because otherwise
        // a swipe to close the left panel would also open the right panel (and v.v.).
        // We do this by checking the data that the framework stores on the page element (panel: open).
        if ( $( ".ui-page-active" ).jqmData( "panel" ) !== "open" ) {
            if ( e.type === "swipeleft" ) {
                $( "#right-panel" ).panel( "open" );
            } else if ( e.type === "swiperight" ) {
                $( "#left-panel" ).panel( "open" );
            }
        }
    });
});

$(document).ready(function(e) {
    config.hide('#messages');
    config.hide('#friends');
    config.hide('#more');
    var onlineList = $('#onlineList');
    var notificationsList = $('#notificationsList');
    var currentId = '#newsfeed';
    var titleHeader = $('#titleHeader');
    var footer = $('#footer');

    config.loadView(e, currentId, '/newsfeed');
    config.loadView(e, '#notificationsList', '/notification');

    setInterval(function(){
        config.prepend('newsfeed/new/posts/' + $('#lastPost').attr('data-id'), '#newsFeed-container', '#lastPost');
        config.prepend('notification/new/' + $('#lastNotification').attr('data-id'), '#notificationContainer', '#lastNotification');

    }, 5000);

    $(onlineList).append(config.loading());
    setTimeout(function(){
        config.refresh(5000, onlineList, '/users/online');
    }, 2000);

    var curPage = 1;
    var isEnd = false;
    var isLoading = false;
    $(window).scroll(function() {
        if(currentId === '#newsfeed') {
            var totalPage = $('#newsFeed-container');
            var ceil = Math.ceil(totalPage.attr('name') / totalPage.attr('value'));
            if($(window).scrollTop() + $(window).height() == $(document).height()) {
                if(isLoading === false) {
                    totalPage.append(config.loading());
                    isLoading = true;
                }
                if(curPage < ceil) {
                    var url = '/newsfeed?page=' + (curPage += 1);
                    setTimeout(function() {
                        $.get(url, function(data) {
                            config.remove('#loading');
                            config.remove('#NoMoreStories');
                            isEnd = false;
                            totalPage.append(data);
                        });
                        isLoading = false
                    }, 1500);
                } else {
                    if(isEnd === false) {
                        isEnd = true;
                        setTimeout(function(){
                            $('#newsFeed-container').append('<div id="NoMoreStories" style="padding-bottom: 10px;" class="text-center"><i class="fa fa-meh-o fa-3x"></i><br/> No more stories</div>');
                        }, 500);
                    }
                }
            }
        }
        config.remove('#loading');
    });
    $(window).on("popstate", function(e) {
        if (e.originalEvent.state !== null) {
            $('#content').load(location.href);
        }
    });
    //Header Navigation click events
    $('#navbarHeader ul li').live('click', function (e) {
        $('#navbarHeader ul li').removeClass('navbar-active');
        $(this).addClass('navbar-active');
        config.hide(currentId);
        currentId = $(this).attr('id');
        titleHeader.text(currentId.substring(1).charAt(0).toUpperCase()+ currentId.slice(2));
        var url = $(this).attr('href');
        //if(url != "/newsfeed")
            config.loadView(e, currentId, url);
        config.show(currentId);
        config.pushToHistory(url);
        e.preventDefault();
    });
    $('a#other').live('click', function(e){
        var url = $(this).attr('data-target');
        var parent = $(this).closest('.list-group-item');
        $.get(url, function(){
            config.remove(parent);
        });
    });
    $('span#name').live('click', function(e){
       var url = $(this).attr('data-target');
        displayPopUp(url);
    });

    //message click events
    $('#message #name a').live('click', function(e) {
        var url = $(this).attr('href');
        titleHeader.text("Messages: " + $(this).text());
        $('.tab-content').hide(250);
        $('#message_container').removeClass('hidden').addClass('visible').show(250);
        config.loadView(e, '#messages_holder', url);
        e.preventDefault();
    });

    $('#tab-content-close').live('click', function () {
        $('#message_container').hide(250);
        $('.tab-content').show();
    });
    $('#formPostStatus').on('submit', function(e) {
        $.post(
            $(this).prop('action'), {
                'message': $('#txtPostStatusMessage').val()
            }, function(data) {
                setTimeout(function(){
                    $('#popUpContent').fadeOut(1000, function(){
                        $('#lightbox').remove();
                        location.reload();
                    });

                }, 1000);
                alert('Successfully posted!');

            },
            'json'
        );
        e.preventDefault();
    });

    $('#btnPostStar').live('click', function(e){
        var currentParent = $(this).closest('.list-group-item');
        var url = $(this).attr('href');
        var starLabel = $(this).children('#starLabel');
        var starCount = $(this).children('#starCount');
        var star = $(this).children('i');
        $(currentParent).css({'border':'1.5px solid rgba(0, 117, 231, 0.5)'});
        setTimeout(function() {
            $(currentParent).css({'border':'1px solid #ddd'});
        }, 1500);
        $.get(url, function(){
           var count = parseInt(starCount.text());
            if (starLabel.text() == 'Star') {
                starCount.text(count+=1);
                starLabel.text('Unstar');
                star.removeClass('fa-star-o');
                star.addClass('fa-star');
            } else {
                starCount.text(count-=1);
                starLabel.text('Star');
                star.removeClass('fa-star');
                star.addClass('fa-star-o');
            }
        });
        e.preventDefault();
    });

    $('#btnPostStatus').live('click', function(e){
        var url = $(this).attr('data-target');
        displayPopUp(url);
    });
    $('#btnLocalSearch').live('click', function(e){
        var url = $(this).attr('data-target');
        displayPopUp(url);
    });
    $('#txtSearch').live('keyup', function(e){
       var name= $(this).val().trim();
        $.ajax({
            type: "POST",
            url: '/search',
            data: {name: name},
            cache: false,
            success: function(data)
            {
                $("#searchContainer").html(data);
            }
        });
    });
    $('#btnPostComment').live('click', function(e){
        var url = $(this).attr('data-target');
        //$('#postCommentsModal').load(url);
        displayPopUp(url);
    });
    $("#btnClosePopUp").live('click', function(){
        var itself = $(this);
        $(itself).closest('#popUpContent').animate({
            'margin-top': '50%'
        }, 1500, 'linear', itself.closest('#lightbox').fadeOut(300)).remove();
        $('#content').show();
    });
    $('#txtPostCommentMessage').live('keypress', function(e){
        var key = e.which;
        var message = $('#txtPostCommentMessage').val().trim();
        if(key === 13) // the enter key code
        {
            if(message.length <= 0){
                alert('Provide you comment.');
                return false;
            }
            else {
                $('#formPostComment').on('submit', function (e) {
                    $.post(
                        $(this).prop('action'), {
                            'message': message
                        }, function () {
                            $('#commentTemp').find('#commentMessage').text(message);
                            $('#commentTemp').find('.post-header').clone().prependTo('#commentSection');
                            $('#txtPostCommentMessage').val('');
                            $('#commentTemp').find('#commentMessage').text('');
                            setTimeout(function(){
                                $('#lightbox').fadeOut(1000, function(){
                                    $('#lightbox').remove();
                                    location.reload();
                                });

                            }, 1000);
                        },
                        'json'
                    );
                    e.preventDefault();
                });

            }
        }

    });
    $('#formCreateGroupChat').on('submit', function(e) {
        $.post(
            $(this).prop('action'), {
                'name': $('#txtCreateGroupChatName').val()
            }, function(data) {
                alert('Successfully added!');
                location.reload();
            },
            'json'
        );
        e.preventDefault();
    });
    $('#txtAddStudentNameToGroupChat').live('keyup', function(){
        var gcid=  $('#txtGCID').val();
        var name = $(this).val().trim();
        if(name.length < 0) {
            $("#searchContainer").hide();
        }
        else {
            var dataString ='name='+name;
            $.ajax({
                type: "POST",
                url: '/messages/mygroup/'+ gcid +'/search',
                data: dataString,
                cache: false,
                success: function(data)
                {
                    $("#addStudentNameToGroupChatSearchContainer").html(data);
                }
            });
        }
    });

    $('#addStudentNameToGroupChatSearchContainer .list-group-item a').live('click', function(){
        var url = $(this).attr('href');
        var parent = $(this).parent();
        $.ajax({
            type: "GET",
            url: url,
            cache: false,
            success: function() {
                config.remove(parent);
            },
            error: function(data, status) {
                alert('Error: ' + data +'\n' + status);
            }
        });
        return false;
    });

    $('#btnPersonalDelete').live('click', function(e){
        var url = $(this).attr('href');
        var parentDiv = $(this);
        $.ajax({
            type : 'GET',
            url : url,
            cache: false,
            success: function(){
                $(parentDiv).closest('.list-group-item').fadeOut(1500).remove();
            }
        });
        return false;
    });

    $('#unfavorite').live('click', function (e) {
        var url =  $(this).attr('data-target');
        $.get(url, function(){
            Location.reload();
        });
    });

    $('#more_groupPage').live('click', function(){
       $('#more_group_pages').slideToggle();
    });

    config.submit('#formGroupPostStatus', {message: $('#txtPostGroupStatusMessage').val()}, e);
});

function displayPopUp(src) {

    var lightbox = '<div id="lightbox">' +
        '<div id="popUpContent" class="myModal">' +

        '</div></div>';
    $('#content').hide();
    $('body').append(lightbox);
    $('#popUpContent').animate({
        'top' : '0'
    }, 250, 'linear', $('#popUpContent').load(src));


}

var config = {
    pushToHistory: function(url) {
        history.pushState({}, '', url);

    },
    submit: function(id, data, e) {
        var dom = e;
        $(id).on('submit', function(e) {
            $.post(
                $(this).prop('action'), data, function(data) {
                    setTimeout(function(){
                        $('#lightbox').fadeOut(1000, function(){
                            $('#lightbox').remove();
                        });

                    }, 1000);
                },
                'json'
            );
            e.preventDefault();
        });
    },
    loading: function(){

        var data = '<div id="loading" class="newNewsfeedContainer" style="height:50px; display: block; width: 100%; text-align: center;">' +
            '<i class="fa fa-3x fa-spinner fa-spin"></i>' +
            '</div>';
        return data;
    },
    hide: function(name) {
        $(name).hide();
    },
    show: function(name) {
        $(name).fadeIn(500)
    },
    loadView: function(e, div, url) {
        if(url === "/newsfeed") {
            $.get(url, function(data) {
                $(div).append(data);

            });
        } else {
            $(div).load(url);
        }

    },
    refresh: function(interval, div, url) {
        setInterval(function() {
            $(div).load(url);
            return false;
        }, interval);
    },
    remove: function(div) {
        $(div).fadeOut(500, function(){
            $(this).remove();
        });
    },
    prepend: function(url, container, lastID) {
        $.get(url, function(data){
            $(lastID).remove();
            $(container).prepend(data);
        });
    }
};
