
$(document).ready(function(){
    function addPerson(i){
        $(document).find("#inputPerson").append(
            '<div class="row" rid="'+i+'">'+
                '<label for="perName" class="col-md-2 control-label">ชื่อผู้รับผิดชอบ</label>'+
                '<input rows="'+i+'" type="text" class="addPerson col-md-3 mt-1 form-control" required="" id="perName" name="perName" value="" placeholder="ชื่อผู้รับผิดชอบ หรือหน่วยงาน" required="">'+
                '<label for="tel" class="mr-1 col-md-1 control-label">โทรศัพท์ </label>'+
                '<input rows="'+i+'" type="tel" class="addPerson col-md-2 mt-1 form-control" required="" id="tel" name="tel" value="" required="">'+
                '<label for="email" class="col-md-1 control-label">E-mail</label>'+
                '<input rows="'+i+'" type="email" class="addPerson col-md-2 mt-1 form-control" required="" id="email" name="email" value="" required="">'+
            '</div>'
        )
    }

    function addBudget(i){
        $(document).find("#inputBudget").append(
            '<div class="row" rid="'+i+'">'+
                ''+
                '<input rows="'+i+'" type="text" class="addBudget col-md-2 mt-1 form-control" required="" id="disBudget" name="disBudget" value="" placeholder="ค่าอาหารและเครื่องดื่ม" required="">'+
                '<label for="num" class="mr-1 col-md-1 control-label">จำนวน</label>'+
                '<input rows="'+i+'" type="number" class="addBudget col-md-1 mt-1 form-control" required="" id="num" name="num" value="" required="">'+
                '<label for="unit" class="mr-1 col-md-1 control-label">หน่วยนับ</label>'+
                '<input rows="'+i+'" type="text" class="addBudget col-md-1 mt-1 form-control" required="" id="unit" name="unit" value="" placeholder="มื้อ" required="">'+
                '<label for="price" class="col-md-2 control-label">ราคาหน่วยละ</label>'+
                '<input rows="'+i+'" type="number" class="addBudget col-md-2 mt-1 form-control" required="" id="price" name="price" value="" required="">'+
            '</div>'
        )
    }

    var proName,proId
    $(document).on('click','#project',function(){
        $('#mainContent').load("pages/project/project.php",function(){
            addPerson(1)
            addBudget(1)
        })
    })
    $(document).on('click','#eec',function(){
        $('#mainContent').load("pages/about/eec.php")
    })
    $(document).on('click','#projectPilot',function(){
        $('#mainContent').load("pages/about/projectPilot.php")
    })
    $(document).on('click','#eecTen',function(){
        $('#mainContent').load("pages/about/eecTen.php")
    })
    $(document).on('click','#eecProAll',function(){
        $('#mainContent').load("pages/about/eecProAll.php")
    })
    function rePreproject(){
        $.ajax({
            type: 'post', 
            dataType: "json",
            url: 'pages/project/preProject.php',
            data: {},
            success: function (data) {
                $('#mainContent').html(data)
                $("#tablePrePro").dataTable()      
            },
        })

    }
    $(document).on('click','#preProject',function(){
        rePreproject()
    })
    $(document).on('click','#preProjectAd',function(){
        rePreproject()
    })

    $(document).on('click','#reportQua',function(){
        $.ajax({
            type: 'post', 
            dataType: "json",
            url: 'pages/report/quaReport.php',
            data: {},
            success: function (data) {
                $('#mainContent').html(data)
                $("#tableReportQua").dataTable()        
            },
        })
    })
    $(document).on('click','#ticket',function(){
        $.ajax({
            type: 'post', 
            dataType: "json",
            url: 'pages/project/ticket.php',
            data: {},
            success: function (data) {
                $('#mainContent').html(data)
                $("#tableTicket").dataTable()         
            },
        })
    })
    $(document).on('click','#listBusi',function(){
        $.ajax({
            type: 'post', 
            dataType: "json",
            url: 'pages/business/listBusiness.php',
            data: {},
            success: function (data) {
                $('#mainContent').html(data)
                $("#allBusiness").dataTable()         
            },
        })
    })
    $(document).on('click','#quarter',function(){
        $.ajax({
            type: 'post', 
            dataType: "json",
            url: 'pages/project/qua.php',
            data: {},
            success: function (data) {
                $('#mainContent').html(data)
                $("#tableQua").dataTable()         
            },
        })
    })
    $(document).on('click','#indicatorMenu',function(){
        $.ajax({
            type: 'post', 
            dataType: "json",
            url: 'pages/project/indicator.php',
            data: {},
            success: function (data) {
                $('#mainContent').html(data)
                $("#tableIndicator").dataTable()        
            },
        })
    })
    $(document).on('click','#manage-schedule',function(){
        $.ajax({
            type: 'post', 
            dataType: "json",
            url: 'pages/schedule/listProSch.php',
            data: {},
            success: function (data) {
                $('#mainContent').html(data)
                $("#tableSchedule").dataTable()        
            },
        })
    })
    function reCheckQua(proName,proId){
        $.ajax({
            type: 'post', 
            dataType: "json",
            url: 'pages/project/listCheckQua.php',
            data: {
                checkQua:true, 
                projectName: proName,
                proId: proId
            },
            success: function (data) {
                $('#mainContent').html(data)
                $("#tablelistCheckQua").dataTable()        
            },
        })
    }
    $(document).on('click','.btn-check-indicator',function(){
        proName = $(this).attr("proName")
        proId = $(this).attr("proId")
        reCheckQua(proName,proId)
    })
    // qua check
    $(document).on('click','.btn-qua-check',function(){
        $.ajax({
            type: 'post', 
            dataType: "json",
            url: 'pages/project/dbCheckQua.php',
            data: {
                updateCheck:true, 
                qua_check: $(this).attr("val"),
                qua_id: $(this).attr("proId")
            },
            success: function (data) {
                if(data){
                    reCheckQua(proName,proId)
                }
            },
        })
    })
    // end qua check
    let projectId_sch = ''
    ///del schedule
    $(document).on('click','.btn-delSch',function(){

        let id = $(this).attr("val")

        const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: 'btn btn-success ml-2',
            cancelButton: 'btn btn-danger'
        },
        buttonsStyling: false
        })

        swalWithBootstrapButtons.fire({
        title: 'ต้องการลบ ใช่ หรือ ไม่ ?',
        text: "",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'ลบ',
        cancelButtonText: 'ยกเลิก',
        reverseButtons: true
        }).then((result) => {
        if (result.value) {
            $.ajax({
                type: 'post', 
                dataType: "json",
                url: 'pages/schedule/dbSchedule.php',
                data: {delSch: true, sch_id: id},
                success: function (data) {
                    if(data == true){
                        swalWithBootstrapButtons.fire(
                        'ลบสำเร็จ',
                        '',
                        'success'
                        )
                        reSch(projectId_sch)               
                    } else {
                        swalWithBootstrapButtons.fire(
                        'ลบไม่สำเร็จ',
                        '',
                        'error'
                        )

                    }    
                },
            })

        } else if (
            /* Read more about handling dismissals below */
            result.dismiss === Swal.DismissReason.cancel
        ) {
            swalWithBootstrapButtons.fire(
            'ยกเลิก',
            '',
            'error'
            )
        }
        })

    })

    /// end del schedule
    //schedule
    function convertD(str) {
        var date = new Date(str+'UTC'),
          mnth = ("0" + (date.getMonth() + 1)).slice(-2),
          day = ("0" + date.getDate()).slice(-2);
        return [date.getFullYear(), mnth, day].join("-");
    }
    function reSch(projectId_sch){
        $.ajax({
            type: 'post', 
            dataType: "json",
            url: 'pages/schedule/schedule.php',
            data: {
                project_id: projectId_sch,
            },
            success: function (data) {
                $('#mainContent').html(data)
                
                    /* initialize the external events
                -----------------------------------------------------------------*/
                function ini_events(ele) {
                    ele.each(function () {
            
                    // create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
                    // it doesn't need to have a start or end
                    var eventObject = {
                        title: $.trim($(this).text()) // use the element's text as the event title
                    }
            
                    // store the Event Object in the DOM element so we can get to it later
                    $(this).data('eventObject', eventObject)
            
                    // make the event draggable using jQuery UI
                    $(this).draggable({
                        zIndex        : 1070,
                        revert        : true, // will cause the event to go back to its
                        revertDuration: 0  //  original position after the drag
                    })
            
                    })
                }
            
                ini_events($('#external-events div.external-event'))
            
                /* initialize the calendar
                -----------------------------------------------------------------*/
                //Date for the calendar events (dummy data)
                var date = new Date()
                var d    = date.getDate(),
                    m    = date.getMonth(),
                    y    = date.getFullYear()
            
                var CalendarSchedule = FullCalendar.Calendar;
                var Draggable = FullCalendarInteraction.Draggable;
            
                var containerEl = document.getElementById('external-events');
                var calendarEl = document.getElementById('CalendarSchedule');
            
                // initialize the external events
                // -----------------------------------------------------------------
                var eventId = null
                new Draggable(containerEl, {
                    itemSelector: '.external-event',
                    eventData: function(eventEl) {
                    console.log(eventEl.id);
                    eventId = eventEl.id
                    return {
                        title: eventEl.innerText,
                        backgroundColor: window.getComputedStyle( eventEl ,null).getPropertyValue('background-color'),
                        borderColor: window.getComputedStyle( eventEl ,null).getPropertyValue('background-color'),
                        textColor: window.getComputedStyle( eventEl ,null).getPropertyValue('color'),
                    };
                    }
                });
                $.ajax({
                    type: 'post', 
                    dataType: "json",
                    url: 'pages/schedule/dbSchedule.php',
                    data: {getSch: true},
                    success: function (data) {
                        if(data){
                            console.log(data)
                            var calendar = new CalendarSchedule(calendarEl, {
                                plugins: [ 'bootstrap', 'interaction', 'dayGrid', 'timeGrid' ],
                                header    : {
                                left  : 'prev,next today',
                                center: 'title',
                                right : 'dayGridMonth,timeGridWeek,timeGridDay'
                                },
                                'themeSystem': 'bootstrap',
                                timeZone: 'bangkok/asia',
                                events: data,
                                editable  : true,
                                droppable : true, // this allows things to be dropped onto the calendar !!!
                                drop      : function(info) {
                                    $.ajax({
                                        type: 'post', 
                                        dataType: "json",
                                        url: 'pages/schedule/dbSchedule.php',
                                        data: {updateDate: true, dateStr: info.dateStr,eventId: eventId},
                                        success: function (data) {
                                            if(data == true){
                                                reSch(projectId_sch)
                                                console.log(data)
                                            } else {
                                                console.log(data)
                                            }    
                                        },
                                    })
                                },
                                eventResize: function(event, delta, revertFunc) {
                                    console.log(event.prevEvent.id)
                                    $.ajax({
                                        type: 'post', 
                                        dataType: "json",
                                        url: 'pages/schedule/dbSchedule.php',
                                        data: {updateEndDate: true, dateStr: event.endDelta.days,eventId: event.prevEvent.id},
                                        success: function (data) {
                                            if(data == true){
                                                console.log(data)
                                            } else {
                                                console.log(data)
                                            }    
                                        },
                                    })
                                }, 
                                eventDrop: function(event, delta, revertFunc) {
                                    let ed = convertD(event.event.end)
                                    let sd = convertD(event.event.start)
                                    $.ajax({
                                        type: 'post', 
                                        dataType: "json",
                                        url: 'pages/schedule/dbSchedule.php',
                                        data: {updateMoveDate: true, startDate: sd, endDate: ed, eventId: event.oldEvent.id},
                                        success: function (data) {
                                            if(data == true){
                                                console.log(data)
                                            } else {
                                                console.log(data)
                                            }    
                                        },
                                    })
                                }, 
                                eventClick: function(calEvent, jsEvent, view) {
                                    /**
                                     * calEvent is the event object, so you can access it's properties
                                     */
                                    let idSch = calEvent.event.id
                                    const swalWithBootstrapButtons = Swal.mixin({
                                        customClass: {
                                            confirmButton: 'btn btn-success ml-2',
                                            cancelButton: 'btn btn-danger'
                                        },
                                        buttonsStyling: false
                                        })
                                
                                        swalWithBootstrapButtons.fire({
                                        title: 'ต้องการลบ ใช่ หรือ ไม่ ?',
                                        text: "",
                                        icon: 'warning',
                                        showCancelButton: true,
                                        confirmButtonText: 'ลบ',
                                        cancelButtonText: 'ยกเลิก',
                                        reverseButtons: true
                                        }).then((result) => {
                                        if (result.value) {
                                            $.ajax({
                                                type: 'post', 
                                                dataType: "json",
                                                url: 'pages/schedule/dbSchedule.php',
                                                data: {delSch: true, sch_id : idSch},
                                                success: function (data) {
                                                    if(data == true){
                                                        console.log(data)
                                                        reSch(projectId_sch)
                                                    } else {
                                                        console.log(data)
                                                    }    
                                                },
                                            })
                                        } else if (
                                            /* Read more about handling dismissals below */
                                            result.dismiss === Swal.DismissReason.cancel
                                        ) {
                                            swalWithBootstrapButtons.fire(
                                            'ยกเลิก',
                                            '',
                                            'error'
                                            )
                                        }
                                        })
                                } 
                            }); 
                            calendar.render();           
                        } else {
                            console.log(data)
                        }    
                    },
                })

                // $('#calendar').fullCalendar()
            
                /* ADDING EVENTS */
                var currColor = '#3c8dbc' //Red by default
                //Color chooser button
                var colorChooser = $('#color-chooser-btn')
                $('#color-chooser > li > a').click(function (e) {
                    e.preventDefault()
                    //Save color
                    currColor = $(this).css('color')
                    //Add color effect to button
                    $('#add-new-event').css({
                    'background-color': currColor,
                    'border-color'    : currColor
                    })
                })
                $('#add-new-event').click(function (e) {
                    e.preventDefault()
                    //Get value and make sure it is not null
                    var val = $('#new-event').val()
                    if (val.length == 0) {
                    return
                    }
            
                    //Create events
                    var event = $('<div />')
                    event.css({
                    'background-color': currColor,
                    'border-color'    : currColor,
                    'color'           : '#fff'
                    }).addClass('external-event')
                    event.html(val)
                    $('#external-events').prepend(event)

                    //Add draggable funtionality
                    ini_events(event)
                    $.ajax({
                        type: 'post', 
                        dataType: "json",
                        url: 'pages/schedule/dbSchedule.php',
                        data: {
                            insertSch: true,
                            project_id: projectId_sch,
                            detail: val,
                        },
                        success: function (data) {  
                            if(data == true){
                                reSch(projectId_sch)
                            }    
                        },
                    })
                    //Remove event from text input
                    
                })  
            },
        })
    }
    $(document).on('click','.btn-schedule',function(){
        projectId_sch = $(this).attr('proId')
        reSch(projectId_sch)

    })
    //schedule end
    /// Edit Profile
    $(document).on('click','.edit-profile',function(){
        $.ajax({
            type: 'post', 
            dataType: "json",
            url: 'pages/business/formBusiness.php',
            data: {id:$(this).attr("valProfile")},
            success: function (data) {
                $('#mainContent').html(data)     
            },
        })
    })
    /// End Edit Profile
    /// Edit business
    $(document).on('click','.btn-editBusi',function(){
        $.ajax({
            type: 'post', 
            dataType: "json",
            url: 'pages/business/formBusiness.php',
            data: {id:$(this).attr("val")},
            success: function (data) {
                $('#mainContent').html(data)     
            },
        })
    })
    $(document).on('submit','#formEditBusi',function(e){
        e.preventDefault()
        $.ajax({
            type: 'post', 
            dataType: "json",
            url: 'pages/business/dbBusiness.php',
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData:false,

            success: function (data) {
                if(data == true){
                    Swal.fire({
                        icon: 'success',
                        title: 'แก้ไขสำเร็จ',
                        text: '',
                        footer: ''   
                    })
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'แก้ไขไม่สำเร็จ',
                        text: '',
                        footer: ''   
                    })
                }        
    
            },
        })
    })
    /// End Edit business
    /// Del business
    $(document).on('click','.btn-delBusi',function(){

        let id = $(this).attr("val")

        const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: 'btn btn-success ml-2',
            cancelButton: 'btn btn-danger'
        },
        buttonsStyling: false
        })

        swalWithBootstrapButtons.fire({
        title: 'ต้องการลบ ใช่ หรือ ไม่ ?',
        text: "",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'ลบ',
        cancelButtonText: 'ยกเลิก',
        reverseButtons: true
        }).then((result) => {
        if (result.value) {
            $.ajax({
                type: 'post', 
                dataType: "json",
                url: 'pages/business/dbBusiness.php',
                data: {delBusi: true, bus_id: id},
                success: function (data) {
                    if(data == true){
                        swalWithBootstrapButtons.fire(
                        'ลบสำเร็จ',
                        '',
                        'success'
                        )
                        $.ajax({
                            type: 'post', 
                            dataType: "json",
                            url: 'pages/business/listBusiness.php',
                            data: {},
                            success: function (data) {
                                $('#mainContent').html(data)
                                $("#allBusiness").dataTable()         
                            },
                        })                
                    } else {
                        swalWithBootstrapButtons.fire(
                        'ลบไม่สำเร็จ',
                        '',
                        'error'
                        )

                    }    
                },
            })

        } else if (
            /* Read more about handling dismissals below */
            result.dismiss === Swal.DismissReason.cancel
        ) {
            swalWithBootstrapButtons.fire(
            'ยกเลิก',
            '',
            'error'
            )
        }
        })

    })
    /// End Del business
    /// disApprove
    $(document).on("click",".disApprove",function(){
        let item = $(this)
        $.ajax({
            type: 'post', 
            dataType: "json",
            url: 'dist/ajax.php',
            data: {disApprove:true, projectId: $(this).attr("val")},
            success: function (data) {
                if(data){
                    item.hide()
                    Swal.fire({
                        icon: 'success',
                        title: 'ไม่อนุมัติสำเร็จ',
                        text: '',
                        footer: ''   
                    })
                    rePreproject()
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'ไม่อนุมัติ ไม่สำเร็จ',
                        text: '',
                        footer: ''   
                    })
                }        
            },
        })
    })
    /// End approve
    /// approve
    $(document).on("click",".viewProject",function(){
        $.ajax({
            type: 'post', 
            dataType: "json",
            url: 'pages/project/viewProject.php',
            data: {
                viewProject:true, 
                projectId: $(this).attr("val"),
            },
            success: function (data) {
                $('#mainContent').html(data.content)         
                var date = new Date()
                var d    = date.getDate(),
                    m    = date.getMonth(),
                    y    = date.getFullYear()

                var Calendar = FullCalendar.Calendar;
                
                var calendarEl = document.getElementById('calendar');
                let i = 0,dateData=[];
                $.each(data.calendar,function(index,value){
                    let newDate = value.split('-')

                    if(index == "start_duration"){
                        $("#dateDetail").append('<p>วันเริ่มโครงการ : '+newDate[2]+"/"+newDate[1]+"/"+newDate[0]+"</p>")
                        dateData[i]={
                            title          : 'วันเริ่มโครงการ',
                            start          : new Date(newDate[0], newDate[1]-1,newDate[2]),
                            allDay         : false,
                            backgroundColor: '#0073b7', //Blue
                            borderColor    : '#0073b7' //Blue
                        }
                    } else if(index == "end_duration") {
                        $("#dateDetail").append('<p>วันสิ้นสุดโครงการ : '+newDate[2]+"/"+newDate[1]+"/"+newDate[0]+"</p>")
                        dateData[i]={
                            title          : 'วันสิ้นสุดโครงการ',
                            start          : new Date(newDate[0], newDate[1]-1,newDate[2]),
                            allDay         : false,
                            backgroundColor: '#0073b7', //Blue
                            borderColor    : '#0073b7' //Blue
                        }
                    }
                    i++
                })
                
                var calendar = new Calendar(calendarEl, {
                    plugins: [ 'bootstrap', 'interaction', 'dayGrid', 'timeGrid' ],
                    header    : {
                        left  : 'prev,next today',
                        center: 'title',
                        right : ''
                    },
                    'themeSystem': 'bootstrap',
                    //Random default events
                    events    : dateData,
                });

                calendar.render();

            },
        })

    })
    $(document).on("click",".approve",function(){
        let item = $(this)

        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success ml-2',
                cancelButton: 'btn btn-danger'
            },
            buttonsStyling: false
            })

        swalWithBootstrapButtons.fire({
            title: 'ต้องการอนุมัติใช่หรือไม่ ?',
            text: "สถานะอนุมัติจะไม่สามารถ แก้ไข หรือ ลบ ได้",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'อนุมัติ',
            cancelButtonText: 'ยกเลิก',
            reverseButtons: true
            }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: 'post', 
                    dataType: "json",
                    url: 'dist/ajax.php',
                    data: {approve:true, projectId: $(this).attr("val")},
                    success: function (data) {
                        if(data){
                            item.hide()
                            Swal.fire({
                                icon: 'success',
                                title: 'อนุมัติสำเร็จ',
                                text: '',
                                footer: ''   
                            })
                            rePreproject()
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'อนุมัติไม่สำเร็จ',
                                text: '',
                                footer: ''   
                            })
                        }        
                    },
                })
            } else if (
                /* Read more about handling dismissals below */
                result.dismiss === Swal.DismissReason.cancel
            ) {
                swalWithBootstrapButtons.fire(
                'ยกเลิก',
                '',
                'error'
                )
            }
            })
    })

    /// End approve
    /// del Qua User
    $(document).on('click','.del-qua-user',function(){

        let id = $(this).attr("val")

        const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: 'btn btn-success ml-2',
            cancelButton: 'btn btn-danger'
        },
        buttonsStyling: false
        })

        swalWithBootstrapButtons.fire({
        title: 'ต้องการลบ ใช่ หรือ ไม่ ?',
        text: "",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'ลบ',
        cancelButtonText: 'ยกเลิก',
        reverseButtons: true
        }).then((result) => {
        if (result.value) {
            $.ajax({
                type: 'post', 
                dataType: "json",
                url: 'pages/project/dbQua.php',
                data: {delQuaUser: true, qua_id: id},
                success: function (data) {
                    if(data == true){
                        swalWithBootstrapButtons.fire(
                        'ลบสำเร็จ',
                        '',
                        'success'
                        )
                        ajaxFormQua(proName,proId) 
                    } else {
                        swalWithBootstrapButtons.fire(
                        'ลบไม่สำเร็จ',
                        '',
                        'error'
                        )

                    }    
                },
            })

        } else if (
            /* Read more about handling dismissals below */
            result.dismiss === Swal.DismissReason.cancel
        ) {
            swalWithBootstrapButtons.fire(
            'ยกเลิก',
            '',
            'error'
            )
        }
        })

    })
    /// End Qua User

    /// del Project
    $(document).on('click','.btn-delProject',function(){
        let id = $(this).attr("val")

        const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: 'btn btn-success ml-2',
            cancelButton: 'btn btn-danger'
        },
        buttonsStyling: false
        })

        swalWithBootstrapButtons.fire({
        title: 'ต้องการลบ ใช่ หรือ ไม่ ?',
        text: "",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'ลบ',
        cancelButtonText: 'ยกเลิก',
        reverseButtons: true
        }).then((result) => {
        if (result.value) {
            $.ajax({
                type: 'post', 
                dataType: "json",
                url: 'pages/project/dbProject.php',
                data: {
                    delProject:true, 
                    project_id : id,
                },
                success: function (data) {
                    if(data == true){
                        swalWithBootstrapButtons.fire(
                        'ลบสำเร็จ',
                        '',
                        'success'
                        )
                        $('#mainContent').load("pages/project/preProject.php")
                    } else {
                        swalWithBootstrapButtons.fire(
                        'ลบไม่สำเร็จ',
                        '',
                        'error'
                        )

                    }
                },
            })

        } else if (
            /* Read more about handling dismissals below */
            result.dismiss === Swal.DismissReason.cancel
        ) {
            swalWithBootstrapButtons.fire(
            'ยกเลิก',
            '',
            'error'
            )
        }
        })
    })
    /// End Project
    /// project
    let valPerson = 0
    let valBudget = 0

    $(document).on("change","#personsNum",function(){
        if($(this).val() > valPerson){
            addPerson($(this).val())
        } else {
            $("#inputPerson").find("div[rid='"+$(this).val()+"']").remove()
        }
        valPerson = $(this).val()
    })
    
    $(document).on("change","#budgetNum",function(){
        if($(this).val() > valBudget){
            addBudget($(this).val())
        } else {
            $("#inputBudget").find("div[rid='"+$(this).val()+"']").remove()
        }
        valBudget = $(this).val()
    })  

    $(document).on("submit","#formProjectInsert",function(e){
        console.log("formProjectInsert")
        let person = {}
        let budget = {}
        let rowPerson
        let rowBudget
        budget.sumPrice = $("#budget").val() 
        $("#inputPerson").find(".addPerson").each(function( index ) {
            if(rowPerson !=  $( this ).attr('rows')){
                rowPerson = $( this ).attr('rows')
                person[$( this ).attr('rows')] = {}
            }
            person[$( this ).attr('rows')][$( this ).attr('id')] = $( this ).val()
        }); 
        $("#inputBudget").find(":input").each(function( index ) {
            if(rowBudget !=  $( this ).attr('rows')){
                rowBudget = $( this ).attr('rows')
                budget[$( this ).attr('rows')] = {}
            }
            budget[$( this ).attr('rows')][$( this ).attr('id')]=$( this ).val()
        }); 
        e.preventDefault()
        $.ajax({
            type: 'post', 
            dataType: "json",
            url: 'pages/project/dbProject.php',
            data: {
                submit:"formProjectInsert", 
                projectName: $("#projectName").val(),
                reason: $("#reason").val(),
                objective : $("#objective").val(),
                maingoal: $("#mainGoal").val(),
                persons: person,
                start_duration: $("#startDuration").val(),
                end_duration: $("#endDuration").val(),
                budget: budget,
                product: $("#product").val(),
                indicator: $("#indicator").val(),
                locations: $("#location").val(),
                busi_id: $("#busi_id").val(),
                branch_no: $("#branch_no").val(),
            },
            success: function (data) {
                if(data){
                    Swal.fire({
                        icon: 'success',
                        title: 'เสนอโครงการสำเร็จ',
                        text: '',
                        footer: ''   
                    })
                    $('#formProjectInsert')[0].reset()

                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'ERROR เกิดข้อผิดพลาด',
                        text: '',
                        footer: ''   
                    })
                }
            },
        })

    }) 

    /// End Project

    ///edit Project
    $(document).on('click','.edit-project',function(){
        $.ajax({
            type: 'post', 
            dataType: "json",
            url: 'pages/project/editProject.php',
            data: {project_id : $(this).attr("val"),},
            success: function (data) {
                $('#mainContent').html(data)      
            },
        })
    })

    $(document).on("submit","#formProjectEdit",function(e){
        let person = {}
        let budget = {}
        let rowPerson
        let rowBudget
        budget.sumPrice = $("#editBudget").val() 
        $("#inputPerson").find(".addPerson").each(function( index ) {
            if(rowPerson !=  $( this ).attr('rows')){
                rowPerson = $( this ).attr('rows')
                person[$( this ).attr('rows')] = {}
            }
            person[$( this ).attr('rows')][$( this ).attr('id')] = $( this ).val()
        }); 
        $("#inputBudget").find(":input").each(function( index ) {
            if(rowBudget !=  $( this ).attr('rows')){
                rowBudget = $( this ).attr('rows')
                budget[$( this ).attr('rows')] = {}
            }
            budget[$( this ).attr('rows')][$( this ).attr('id')]=$( this ).val()
        }); 
        e.preventDefault()
        $.ajax({
            type: 'post', 
            dataType: "json",
            url: 'pages/project/dbProject.php',
            data: {
                formProjectEdit:true, 
                project_id: $("#project_id").val(),
                projectName: $("#editProjectName").val(),
                reason: $("#editReason").val(),
                objective : $("#editObjective").val(),
                maingoal: $("#editMainGoal").val(),
                persons: person,
                start_duration: $("#editStartDuration").val(),
                end_duration: $("#editEndDuration").val(),
                budget: budget,
                product: $("#editProduct").val(),
                indicator: $("#editIndicator").val(),
                locations: $("#editLocation").val(),
                status: $("#proStatus").val()
            },
            success: function (data) {
                if(data == true){
                    Swal.fire({
                        icon: 'success',
                        title: 'แก้ไขโครงการสำเร็จ',
                        text: '',
                        footer: ''   
                    })
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'ERROR เกิดข้อผิดพลาด',
                        text: '',
                        footer: ''   
                    })
                }
            },
        })

    }) 

    /// End Project

    /// quaReport
    
    let project_id
    
    $(document).on('click','.btn-report',function(){
        project_id = $(this).attr('val')
        $.ajax({
            type: 'post', 
            dataType: "json",
            url: 'pages/report/detailQua.php',
            data: {project_id: project_id },
            success: function (data) {
                $('#mainContent').html(data) 
                $("#tableDetailReport").dataTable()      
            },
        })
    })
    $(document).on("change","#qua_select",function(){
        $.ajax({
            type: 'post', 
            dataType: "json",
            url: 'pages/report/detailQua.php',
            data: {
                project_id: project_id,
                qua_select: $(this).val(),
                Y_select : $("#Y_select").val(),
                status_select: $("#status_select").val(),
            },
            success: function (data) {
                $('#mainContent').html(data) 
                $("#tableDetailReport").dataTable()      
            },
        })
    })

    $(document).on("change","#Y_select",function(){
        $.ajax({
            type: 'post', 
            dataType: "json",
            url: 'pages/report/detailQua.php',
            data: {
                project_id: project_id,
                Y_select: $(this).val(),
                qua_select : $("#qua_select").val(),
                status_select: $("#status_select").val(),
 
            },
            success: function (data) {
                $('#mainContent').html(data) 
                $("#tableDetailReport").dataTable()      
            },
        })
    })
    
    $(document).on("change","#status_select",function(){
        $.ajax({
            type: 'post', 
            dataType: "json",
            url: 'pages/report/detailQua.php',
            data: {
                project_id: project_id,
                status_select: $(this).val(),
                qua_select : $("#qua_select").val(),
                Y_select: $("#Y_select").val(),
            },
            success: function (data) {
                $('#mainContent').html(data) 
                $("#tableDetailReport").dataTable()      
            },
        })
    })

    /// End quaReport
    /// quarter
    function ajaxFormQua(proName,proId){
        $.ajax({
            type: 'post', 
            dataType: "json",
            url: 'pages/project/formQua.php',
            data: {
                ticket:true, 
                projectName: proName,
                proId: proId
            },
            success: function (data) {
                $('#mainContent').html(data)
            },
        })
    }

    $(document).on('click','.btn-qua',function(){
        proName = $(this).attr("proName")
        proId = $(this).attr("proId")
        ajaxFormQua(proName,proId)
    })

    $(document).on('click','.edit-qua',function(){
        let topic = $(this).parents(".input-qua").find(".topicQua")
        topic.prop( "disabled", false )
        $(this).parents(".input-qua").find(".edit-qua-save").show()
        $(this).hide()
    })

    $(document).on('click','.edit-qua-user',function(){
        let topicQua = $(this).parents(".input-qua").find(".topicQua")
        let detailQua = $(this).parents(".input-qua").find(".detailQua")
        topicQua.prop( "disabled", false )
        detailQua.prop( "disabled", false )
        $(this).parents(".input-qua").find(".edit-qua-save-user").show()
        $(this).hide()
    })

    $(document).on('click','.edit-qua-save-user',function(){
        let topicQua = $(this).parents(".input-qua").find(".topicQua")
        let detailQua = $(this).parents(".input-qua").find(".detailQua")
        topicQua.prop( "disabled", true )
        $(this).parents(".input-qua").find(".edit-qua").show()
        $(this).hide()
        $.ajax({
            type: 'post', 
            dataType: "json",
            url: 'pages/project/dbQua.php',
            data: {
                editQuaUser:true, 
                topicQua: topicQua.val(),
                detailQua: detailQua.val(),
                qua_id: $(this).attr("val")
            },
            success: function (data) {
                if(data == true){
                    Swal.fire({
                        icon: 'success',
                        title: 'บันทึกสำเร็จ',
                        text: '',
                        footer: ''   
                    })
                    ajaxFormQua(proName,proId)
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'ERROR เกิดข้อผิดพลาด',
                        text: '',
                        footer: ''   
                    })
                }
            },
        })
    })

    $(document).on('click','.edit-qua-save',function(){
        let detail = $(this).parents(".input-qua").find(".topicQua")
        detail.prop( "disabled", true )
        $(this).parents(".input-qua").find(".edit-qua").show()
        $(this).hide()
        $.ajax({
            type: 'post', 
            dataType: "json",
            url: 'pages/project/dbQua.php',
            data: {
                editQua:true, 
                detailQua: detail.val(),
                qua_id: $(this).attr("val")
            },
            success: function (data) {
                if(data == true){
                    Swal.fire({
                        icon: 'success',
                        title: 'บันทึกสำเร็จ',
                        text: '',
                        footer: ''   
                    })
                    ajaxFormQua(proName,proId)
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'ERROR เกิดข้อผิดพลาด',
                        text: '',
                        footer: ''   
                    })
                }
            },
        })
    })

    $(document).on('submit','#formQua',function(e){
        e.preventDefault()
        $.ajax({
            url: "pages/project/dbQua.php",
            type: "POST",
            data:  new FormData(this),
            contentType: false,
            cache: false,
            processData:false,
            success: function(data) {
                if(data == 'true'){
                    Swal.fire({
                        icon: 'success',
                        title: 'บันทึกสำเร็จ',
                        text: '',
                        footer: ''   
                    })
                    ajaxFormQua(proName,proId)
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'ERROR เกิดข้อผิดพลาด',
                        text: '',
                        footer: ''   
                    })
                }
            }
        })
    })
    // END quarter
    /// indicator
    function ajaxFormIndicator(proName,proId){
        $.ajax({
            type: 'post', 
            dataType: "json",
            url: 'pages/project/formIndicator.php',
            data: {
                ticket:true, 
                projectName: proName,
                proId: proId
            },
            success: function (data) {
                $('#mainContent').html(data)
            },
        })
    }
    
    $(document).on('click','.btn-indicator',function(){
        proName = $(this).attr("proName")
        proId = $(this).attr("proId")
        ajaxFormIndicator(proName,proId)
    })

    $(document).on('click','.edit-indicator',function(){
        let topic = $(this).parents(".input-indicator").find(".topicIndicator")
        topic.prop( "disabled", false )
        $(this).parents(".input-indicator").find(".edit-indicator-save").show()
        $(this).hide()
    })
    $(document).on('click','.edit-indicator-save',function(){
        let topic = $(this).parents(".input-indicator").find(".topicIndicator")
        topic.prop( "disabled", true )
        $(this).parents(".input-indicator").find(".edit-indicator").show()
        $(this).hide()
        $.ajax({
            type: 'post', 
            dataType: "json",
            url: 'pages/project/dbIndicator.php',
            data: {
                editIndicator:true, 
                topicIndicator: topic.val(),
                qua_id: $(this).attr("val")
            },
            success: function (data) {
                if(data == true){
                    Swal.fire({
                        icon: 'success',
                        title: 'บันทึกสำเร็จ',
                        text: '',
                        footer: ''   
                    })
                    ajaxFormIndicator(proName,proId)
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'ERROR เกิดข้อผิดพลาด',
                        text: '',
                        footer: ''   
                    })
                }
            },
        })

    })

    $(document).on('submit','#formIndicator',function(e){
        e.preventDefault()
        $.ajax({
            url: "pages/project/dbIndicator.php",
            type: "POST",
            data:  new FormData(this),
            contentType: false,
            cache: false,
            processData:false,
            success: function(data) {
                Swal.fire({
                    icon: 'success',
                    title: 'บันทึกสำเร็จ',
                    text: '',
                    footer: ''   
                })
                ajaxFormIndicator(proName,proId)
            }
        })
    })
    $(document).on('click','.del-indicator',function(){

        let id = $(this).attr("val")
        let btn = $(this)
        const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: 'btn btn-success ml-2',
            cancelButton: 'btn btn-danger'
        },
        buttonsStyling: false
        })

        swalWithBootstrapButtons.fire({
        title: 'ต้องการลบ ใช่ หรือ ไม่ ?',
        text: "",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'ลบ',
        cancelButtonText: 'ยกเลิก',
        reverseButtons: true
        }).then((result) => {
        if (result.value) {
            $.ajax({
                type: 'post', 
                dataType: "json",
                url: 'pages/project/dbIndicator.php',
                data: {
                    delIndicator:true, 
                    qua_id : id,
                },
                success: function (data) {
                    if(data == true){
                        swalWithBootstrapButtons.fire(
                        'ลบสำเร็จ',
                        '',
                        'success'
                        )
                        ajaxFormIndicator(proName,proId)
                    } else {
                        swalWithBootstrapButtons.fire(
                        'ลบไม่สำเร็จ',
                        '',
                        'error'
                        )

                    }
                },
            })

        } else if (
            /* Read more about handling dismissals below */
            result.dismiss === Swal.DismissReason.cancel
        ) {
            swalWithBootstrapButtons.fire(
            'ยกเลิก',
            '',
            'error'
            )
        }
        })
    })
    ///END indicator
    $(document).on('click','#register',function(){
        $("#tableSearchVat").html('<div class="topic-search-vat mt-10">ค้นหาข้อมูลจากสรรพากร</div><div id="spinners" class="canter spinner loader"></div>')
        $("#spinners").hide()
        $("#formInsert").hide()
        $("#tableSearchVat").show()
        // Swal.fire(
        //     'Good job!',
        //     'You clicked the button!',
        //     'success'
        // )
    })
    function setEmpty() {
        $("#business_vat").val("")
        $("#branch_number_vat").val("")
        $("#business_name").val("")
        $("#business_branch").val("")
        $("#amount_emp").val("")
        $("#job_description").val("")
        $("#house_code").val("")
        $("#address_no").val("")
        $("#road").val("")
        $("#land").val("")
        $("#location").val("")
        $("#email").val()
        $("#business_phone").val("")
        $("#registration_date").val("")
        $("#capital").val("")
    }
    
    $("#formSearchVat").submit(function(e)  {
        $("#tableSearchVat").html('<div class="topic-search-vat mt-10">ค้นหาข้อมูลจากสรรพากร</div><div id="spinners" class="canter spinner loader"></div>')
        $("#spinners").show()
        $("#formInsert").hide()
        $("#tableSearchVat").show()
        setEmpty()
        e.preventDefault()
        $.ajax({
          type: 'post', 
          dataType: "json",
          url: 'pages/tableVat/tableSearchVat.php',
          data: {submit:"nameSearchVat", name: $("#business_name_search").val()},
          success: function (data) {
            $("#spinners").hide()
            $("#tableSearchVat").html(data)
            $('#busiTable').dataTable();            
          },
        })
    }) 
    var rowData = {}
    $(document).on('change', '#province_id', function () {
      $.ajax({
          type: 'post', 
          dataType: "json",
          url: 'dist/ajax.php',
          data: {provinces: true, id: $(this).val()},
          success: function (data) {
              $("#district_id").html("")
              $("#district_id").append(
                      '<option id="district_id_list" > -- กรุณาเลือกอำเภอ/เขต -- </option>'
                  )
  
              $.each( data, function( key, value ) {
                  $("#district_id").append(
                      '<option value="'+value.id+'">'+value.name+'</option>'
                  )
              });
              $("#postcode").val("")
              $("#subdistrict_id").html('<option id="subdistrict_id_list"> -- กรุณาเลือกตำบล -- </option>')
          },
      })
  
    })
    let zipCode
    $(document).on('change', '#district_id', function () {
      $.ajax({
          type: 'post', 
          dataType: "json",
          url: 'dist/ajax.php',
          data: {district_id: true, id: $(this).val()},
          success: function (data) {
              $("#subdistrict_id").html("")
              $("#subdistrict_id").append(
                  '<option id="subdistrict_id_list"> -- กรุณาเลือกตำบล -- </option>'
              )
  
              $.each( data, function( key, value ) {
                  $("#subdistrict_id").append(
                      '<option zip="'+value.zip_code+'" value="'+value.id+'">'+value.name+'</option>'
                  )
              });
          },
      })
  
    })
  
    $(document).on('change', '#subdistrict_id', function () {
      $("#postcode").val($(this).val())
    })
  
  
    $(document).on('click', '.row-vat', function () {
      $(this).find('td').each(function() {
        var cellText = $(this).html()
        rowData[$(this).attr("key")] = cellText
      });
      let vDate = rowData.vBusinessFirstDate.split('/')
      let address = rowData.vaddress.split(',')
      $("#business_vat").val(rowData.vNID)
      $("#branch_number_vat").val(rowData.vBranchNumber)
      $("#business_name").val(replaceStr(rowData.vName))
      $("#registration_date").val(vDate[0]+"-"+vDate[1]+"-"+vDate[2])
      $("#postcode").val(rowData.vPostCode)
      $("#address_no").val(address[0]+" หมู่ "+address[1]+" ซอย "+address[2])
      $("#province_id").find("option").each(function(){
          if($(this).text() == address[5].replace(/ /g,"")){
              $(this).attr("selected", true)
          }
      })
      $("#district_id").find("option").each(function(){
          if($(this).text() == address[4].replace(/ /g,"")){
              $(this).attr("selected", true)
          }
      })
      $("#subdistrict_id").find("option").each(function(){
          if($(this).text() == address[3].replace(/ /g,"")){
              $(this).attr("selected", true)
          }
      })
      
      $("#formInsert").show()
      $("#tableSearchVat").hide()
  
    });
  
    $("#formRegister").submit(function(e){
        e.preventDefault()
        let password = $("#passRegis").val()
        if(password != $("#passCon").val()){
            $("#checkPass").html(
                '<b style="color: red;" class="ml-3">รหัสผ่านไม่ตรงกัน</b>'
            )
            return
        }
        $.ajax({
            type: 'post', 
            dataType: "json",
            url: 'pages/register/dbRegister.php',
            data: {
                submit:"formRegister", 
                business_vat: $("#business_vat").val(),
                branch_number_vat: $("#branch_number_vat").val(),
                business_name: $("#business_name").val(),
                business_branch: $("#business_branch").val(),
                business_size: $("#business_size").val(),
                amount_emp: $("#amount_emp").val(),
                job_description: $("#job_description").val(),
                province_id: $("#province_id").val(),
                district_id: $("#district_id").val(),
                subdistrict_id: $("#subdistrict_id").val(),
                postcode: $("#postcode").val(),
                house_code: $("#house_code").val(),
                address_no: $("#address_no").val(),
                road: $("#road").val(),
                land: $("#land").val(),
                location: $("#location").val(),
                email: $("#email").val(),
                business_phone: $("#business_phone").val(),
                registration_date: $("#registration_date").val(),
                capital: $("#capital").val(),
                tax_break: $("#tax_break").val(),
                password: password,
                group_eec: $("#group_eec").val(),
            },
            success: function (data) {
                if(data){
                Swal.fire({
                    icon: 'success',
                    title: 'สมัครใช้งานสำเร็จ',
                    text: '',
                    footer: ''   
                })
                $("#regisContent").html("")
                $('#modal-register').modal('hide');
                } else {
                Swal.fire({
                    icon: 'error',
                    title: 'สมัครใช้งานไม่สำเร็จ',
                    text: '',
                    footer: ''   
                })
                }
            },
        })
    }) 

  
    function replaceStr($str){
      return $str.replace(/-/g, "")
    }
    /// ticket.php
    $(document).ready(function(){
        $.ajaxSetup({
            cache: true
        });
        $("#tablePrePro").dataTable()
        $(document).on("click",".btn-ticket",function(){
            let item = $(this)
            $.ajax({
                type: 'post', 
                dataType: "json",
                url: 'pages/project/formticket.php',
                data: {
                    ticket:true, 
                    projectName: $(this).attr("proName"),
                    proId: $(this).attr("proId")
                },
                success: function (data) {
                    $('#mainContent').html(data)
                },
            })
        })

        var projectName = ""
        var proId = ""
        function reListTicket(projectName,proId){
            $.ajax({
                type: 'post', 
                dataType: "json",
                url: 'pages/project/listTicket.php',
                data: {
                    ticket:true, 
                    projectName: projectName,
                    proId: proId
                },
                success: function (data) {
                    $('#mainContent').html(data)
                    $("#tableListTicket").dataTable()
                },
            })
        }
        $(document).on("click",".all-ticket",function(){
            projectName = $(this).attr("proName")
            proId = $(this).attr("proId")
            reListTicket(projectName,proId)
        })

        $(document).on("click",".del-ticket",function(){
            let id = $(this).attr("val")
            let btn = $(this)
            const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success ml-2',
                cancelButton: 'btn btn-danger'
            },
            buttonsStyling: false
            })

            swalWithBootstrapButtons.fire({
            title: 'ต้องการลบ ใช่ หรือ ไม่ ?',
            text: "",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'ลบ',
            cancelButtonText: 'ยกเลิก',
            reverseButtons: true
            }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: 'post', 
                    dataType: "json",
                    url: 'pages/project/dbTicket.php',
                    data: {
                        delTicket:true, 
                        qua_id : id,
                    },
                    success: function (data) {
                        if(data){
                            swalWithBootstrapButtons.fire(
                            'ลบสำเร็จ',
                            '',
                            'success'
                            )
                            reListTicket(projectName,proId)

                        } else {
                            swalWithBootstrapButtons.fire(
                            'ลบไม่สำเร็จ',
                            '',
                            'error'
                            )

                        }
                    },
                })

            } else if (
                /* Read more about handling dismissals below */
                result.dismiss === Swal.DismissReason.cancel
            ) {
                swalWithBootstrapButtons.fire(
                'ยกเลิก',
                '',
                'error'
                )
            }
            })
        })

        $(document).on("submit","#formTicket",function(e){
            console.log("formTicket");
            e.preventDefault()
            let formTicket = $(this)
            $.ajax({
                url: "pages/project/dbTicket.php",
                type: "POST",
                data:  new FormData(this),
                contentType: false,
                cache: false,
                processData:false,
                success: function(data) {
                    if(data){
                        Swal.fire({
                            icon: 'success',
                            title: 'รายงานปัญหาสำเร็จ',
                            text: '',
                            footer: ''   
                        })
                        $()
                        //formTicket[0].reset();
                        $("#topic").val("")
                        $("#detail").val("")
                        $("#files").val("")
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'ERROR เกิดข้อผิดพลาด',
                            text: '',
                            footer: ''   
                        })
                    }
                }
            })
        })
    })
    // END ticket.php
})

