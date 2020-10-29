jQuery.noConflict();
jQuery(function ($) {
    let participants = '';
    let winner = '';
    let index = '';
    let winnerId = '';
    let eventId = document.getElementById("event-id").value;
    let prizeId = document.getElementById("prize-id").value;
    let branch = document.getElementById("branch").value;
    let prizeType = document.getElementById("prize-type").value;
    let rouletter = '';
    let rouletter2 = '';
    let rouletter3 = '';
    let rouletter4 = '';
    let rouletter5 = '';
    let rouletter6 = '';
    let rouletter7 = '';
    let rouletter8 = '';
    let s1, s2, s3, s4,s5,s6,s7,s8;
    let r1, r2, r3, r4,r5,r6,r7,r8;
    let currentPrize = null;

    // $('.start').attr('disabled', 'true');

    // if (participants.length >= 0 ) {       
    //     $('.start').removeAttr('disabled');
    // } else {
    //     $('.start').attr('disabled', 'true');
    // }

    $('body').keydown(function (e) {
        if (e.keyCode === 32) {
            $("p").addClass("winner-name-hide");
            confetti.maxCount = 0;
            confetti.stop();
            startRoulette();
        }
    })

    init = function () {

    }
    
    r1 = {
        speed: 50,
        duration: 3,
        startCallback: function () {
            $('.start').attr('disabled', 'true');
            $(".winner-name").text("");

            $('winner-name').css('display', 'none');

        },
        slowDownCallback: function () {

        },
        stopCallback: function () {

        }

    }

    r2 = {
        speed: 60,
        duration: 4,

        startCallback: function () {

        },
        slowDownCallback: function () {

        },
        stopCallback: function () {

        }

    }

     r3 = {
        speed: 70,
        duration: 5,

        startCallback: function () {

        },
        slowDownCallback: function () {

        },
        stopCallback: function () {

        }

    }

    r4 = {
        speed: 80,
        duration: 6,
        startCallback: function () {
        },
        slowDownCallback: function () {
        },
        stopCallback: function () {
        }
    }

    r5 = {
        speed: 100,
        duration: 7,
        startCallback: function () {},
        slowDownCallback: function () {
            confetti.maxCount = 500;
            setTimeout(() => {
                saveWinner();
                $(".winner-name").text(winner.full_name);
                $(".winner-address").text(winner.address);
                confetti.start();
                $('.start').removeAttr('disabled');
            }, 1500);

            setTimeout(() => {
                confetti.stop();
            }, 4000);

        },
        stopCallback: function () {
        }
    }


    // r6 = {
    //     speed: 100,
    //     duration: 8,
    //     startCallback: function () {},
    //     slowDownCallback: function () {

    //     },
    //     stopCallback: function () {

    //     }

    // }

    // r7 = {
    //     speed: 105,
    //     duration: 9,
    //     startCallback: function () {},
    //     slowDownCallback: function () {

    //     },
    //     stopCallback: function () {
    //     }
    // }

    // r8 = {
    //     speed: 110,
    //     duration: 10,
    //     startCallback: function () {},
        
    //     stopCallback: function () {

    //     }

    // }

    function startRoulette() {

        index = Math.floor((Math.random() * participants.length - 1) + 1);
        winner = participants[index];
        winnerId = Array.from(String(winner.ticket_no), Number);
        

        updateParamater(winnerId);

        rouletter.roulette('start');
        rouletter2.roulette('start');
        setTimeout(() => {
          rouletter3.roulette('start');
        }, 80);
        setTimeout(() => {
          rouletter4.roulette('start');
        }, 100);
        rouletter5.roulette('start');
  
        // rouletter6.roulette('start');
        // rouletter7.roulette('start');
        // rouletter8.roulette('start');

    }

    var getPrizeDetail = function() {
        jQuery.get(`/api/administration/prizes/${prizeId}`, function(data) {
            currentPrize = data;
            console.log('currentPrize',currentPrize)
        })
    }

    var getNotWinners = function () {
        jQuery.get(`/api/administration/event/participants?event_id=${eventId}&branch=${branch}&prize_type=${prizeType}`, function (data) {
            participants = data;        
            if (participants.length >= 1 && currentPrize.remaining >= 1) {       
                $('.start').removeAttr('disabled');
            } else {
                $('.start').attr('disabled', 'true');
            }
        });
    }


    var getRafflePrize = function () {
        jQuery.get("/currentPrize", function (data) {
            $("#raffle-prize-label").html(`${data.prize} - ${data.description}`);
        })
    }

    getPrizeDetail();
    getNotWinners();

    function saveWinner() {
        var data = {
            participant_id: winner.participant_id,
            participant_name: winner.full_name,
            ticket_no: winner.ticket_no,
            branch: winner.branch,
            prize_id: prizeId,
            event_id: eventId,
        }
        $.ajax({
            url: "/api/administration/event/winner",
            type: "post",
            data: data,
            success: function (data) {
                toastr.success(`${winner.full_name} successfully added to winners`, "Success");
                getPrizeDetail();
                getNotWinners();
            }
        });
    }

    var updateParamater = function (arrayNumber) {
    
        r1['stopImageNumber'] = Number(arrayNumber[0]);
        r2['stopImageNumber'] = Number(arrayNumber[1]);
        r3['stopImageNumber'] = Number(arrayNumber[2]);
        r4['stopImageNumber'] = Number(arrayNumber[3]);
        r5['stopImageNumber'] = Number(arrayNumber[4]);
        // r6['stopImageNumber'] = Number(arrayNumber[5]);
        // r7['stopImageNumber'] = Number(arrayNumber[6]);
        // r8['stopImageNumber'] = Number(arrayNumber[7]);

        // r1['duration'] = parseInt(s1);
        // r2['duration'] = parseInt(s2);
        // r3['duration'] = parseInt(s3);
        // r4['duration'] = parseInt(s4);

        rouletter.roulette('option', r1);
        rouletter2.roulette('option', r2);
        rouletter3.roulette('option', r3);
        rouletter4.roulette('option', r4);
        rouletter5.roulette('option', r5);
        // rouletter6.roulette('option', r6);
        // rouletter7.roulette('option', r7);
        // rouletter8.roulette('option', r8);
    }


    $('.start').click(function () {
        confetti.stop()
        startRoulette();
        $(".winner-name").text("");
    });

    rouletter = $('div#roulette1');
    rouletter2 = $('div#roulette2');
    rouletter3 = $('div#roulette3');
    rouletter4 = $('div#roulette4');
    rouletter5 = $('div#roulette5');
    rouletter6 = $('div#roulette6');
    rouletter7 = $('div#roulette7');
    rouletter8 = $('div#roulette8');

    rouletter.roulette(r1);
    rouletter2.roulette(r2);
    rouletter3.roulette(r3);
    rouletter4.roulette(r4);
    rouletter5.roulette(r5);
    rouletter6.roulette(r6);
    rouletter7.roulette(r7);
    rouletter8.roulette(r8);

});
