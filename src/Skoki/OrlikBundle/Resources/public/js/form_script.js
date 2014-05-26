
function nextRound() {
    var roundsNumber = parseInt($('#match-fixtures').attr('number'));
    var activeTable = $('.tab-active');
    var $classList = $('.tab-active div.table-container-matches').attr('class').split(' ');
    var $roundNumber = $classList[1].split('-');
    var curentRound = parseInt($roundNumber[1]);
    curentRound = curentRound + 1;
    if (curentRound > roundsNumber) {
        curentRound = 1;
    }
    var classNext = 'round-' + (curentRound);

    $('.table-container-matches').each(function(){
        if ($(this).hasClass(classNext)) {
            var toChange = $(this).parent("div");
            activeTable.removeClass('tab-active');
            activeTable.addClass('tab-deactive');
            toChange.addClass('tab-active');
            toChange.removeClass('tab-deactive');
        }
    });
};

function prevRound() {
    var roundsNumber = parseInt($('#match-fixtures').attr('number'));
    var activeTable = $('.tab-active');
    var $classList = $('.tab-active div.table-container-matches').attr('class').split(' ');
    var $roundNumber = $classList[1].split('-');
    var curentRound = parseInt($roundNumber[1]);
    curentRound--;
    if (curentRound < 1) {
        curentRound = roundsNumber;
    }
    var classPrev = 'round-' + curentRound;
    $('.table-container-matches').each(function(){
        if ($(this).hasClass(classPrev)) {
            var toChange = $(this).parent("div");
            activeTable.removeClass('tab-active');
            activeTable.addClass('tab-deactive');
            toChange.addClass('tab-active');
            toChange.removeClass('tab-deactive');
        }
    });
}

$(document).ready(function()
{
    $('.buttonForm').onclick(function(){
        $('form').submit();
    });
    $('#match-fixtures .timetable').each(function(){
        if (!$(this).hasClass('lastone')){
            $(this).hide();
        }
    });
});

