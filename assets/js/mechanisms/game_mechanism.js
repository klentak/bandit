var $ = require('jquery');


$(document).ready(function () {
var slot_machine = {

    bid: $('#bid').val(),

    generate: function(){
        this.number1= Math.floor(Math.random() * 10);
        this.number2= Math.floor(Math.random() * 10);
        this.number3= Math.floor(Math.random() * 10);

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


    history: function() {

        var history = {
            numbers: [this.number1, this.number2, this.number3,],
            result: this.win,
            bid: this.bid,
        };
        console.log(history);

        $.ajax({
            method: "post",
            url: 'game/save_result',
            dataType: "json",
            data: history
        });

        score();
    },

    end: function() {
        var score;

        $.ajax({
            method: "post",
            url: 'game/get_score',
            dataType: "json",
            success: function (score) {
                $('#score').html('$ ' + score['score']);
            },
        });
    }



};

$('#btn').click(function () {
    slot_machine.generate();
    var raffle = setInterval(slot_machine.random_numbers, 50);
        $.ajax({
            method: "post",
            url: 'game/get_score',
            dataType: "json",
            success: function (score) {
                if (score['score'] > $('#bid').val()) {
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
                                    setTimeout(clearInterval(raffle), 1000);
                                    slot_machine.win_numbers();
                                    $('#score').html('$ ' + score['score']);
                                },
                            });

                        },
                        });
                } else {
                    alert("Nie masz wystarczającej ilości punktów!");
                }
            },
        });
    });
});