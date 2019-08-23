var $ = require('jquery');


$(document).ready(function () {
var slot_machine = {

    bid: function(){
        return $('#bid').val();
    },

    generate: function(){
        this.number1= Math.floor(Math.random() * 10);
        this.number2= Math.floor(Math.random() * 10);
        this.number3= Math.floor(Math.random() * 10);

        // this.number1= 1;
        // this.number2= 1;
        // this.number3= 1;

        this.win = (this.number1 === this.number2 && this.number1 === this.number3);
    },

    random_numbers: function() {
        $('#slot1').html(Math.floor(Math.random() * 10));
        $('#slot2').html(Math.floor(Math.random() * 10));
        $('#slot3').html(Math.floor(Math.random() * 10));
    },

    win_numbers: function() {
        $('#slot1').html(this.number1);
        $('#slot2').html(this.number2);
        $('#slot3').html(this.number3);
    },

    view_result: function(){
        if(this.win){
            $('#result').html(this.bid()*100);
            $('#gameBar').css( "background-color", "red");
            $('#gameBar').css( "color", "#C4C4C4");
            $('#gameBar').removeClass("bg-light");
            $('#result').removeClass("text-danger");
            $('#result').css( "color", "white");
        }else{
            // $('#result').html("");
            $('#result').html(":(");
        }
    },

    default: function () {
        $('#slot1').html("$");
        $('#slot2').html("$");
        $('#slot3').html("$");
    },

    reset: function () {
        $('#btn').attr("disabled", true);
        $('#result').html("");
        $('#gameBar').css( "background-color", "");
        $('#gameBar').css( "color", "");
        $('#gameBar').addClass("bg-light");
        $('#result').addClass("text-danger");
        $('#result').css( "color", "1");
    }
};

$('#btn').click(function () {
    slot_machine.reset();
    slot_machine.generate();
    var raffle = setInterval(slot_machine.random_numbers, 150);
        $.ajax({
            method: "post",
            url: 'game/get_score',
            dataType: "json",
            success: function (score) {
                if (score['score'] >= $('#bid').val()) {
                    $.ajax({
                        method: "post",
                        url: 'game/save_result',
                        dataType: "json",
                        data: {
                            numbers: [slot_machine.number1, slot_machine.number2, slot_machine.number3,],
                            result: slot_machine.win,
                            bid: slot_machine.bid,
                        },
                        success: function() {
                            $.ajax({
                                method: "post",
                                url: 'game/get_score',
                                dataType: "json",
                                success: function (score) {
                                    $.wait( function(){
                                    clearInterval(raffle);
                                    slot_machine.win_numbers();
                                    slot_machine.view_result();
                                    $('#score').html('$ ' + score['score']);
                                    $('#btn').attr("disabled", false);
                                    }, 2);
                                }
                            });
                        }
                    });
                } else {
                    clearInterval(raffle);
                    slot_machine.default();
                    console.log('cls');
                    alert("Nie masz wystarczającej ilości punktów!");
                    $('#btn').attr("disabled", false);
                }
            },
        });
    });
});

$.wait = function( callback, seconds){
    return window.setTimeout( callback, seconds * 1000 );
};