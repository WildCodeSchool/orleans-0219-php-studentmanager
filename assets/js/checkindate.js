function DateTime() {
    function getDaySuffix(a) {
        var b = "" + a,
            c = b.length,
            d = parseInt(b.substring(c-2, c-1)),
            e = parseInt(b.substring(c-1));
        if (c == 2 && d == 1) return "";
        switch(e) {
            case 1:
                return "";
                break;
            case 2:
                return "";
                break;
            case 3:
                return "";
                break;
            default:
                return "";
                break;
        };
    };

    this.getDoY = function(a) {
        var b = new Date(a.getFullYear(),0,1);
        return Math.ceil((a - b) / 86400000);
    }

    this.date = arguments.length == 0 ? new Date() : new Date(arguments);

    this.weekdays = new Array('Dimanche', 'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi');
    this.months = new Array('Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre');

    this.day = {
        index: {
            week: "0" + this.date.getDay(),
            month: (this.date.getDate() < 10) ? "0" + this.date.getDate() : this.date.getDate()
        },
        name: this.weekdays[this.date.getDay()],
        of: {
            week: ((this.date.getDay() < 10) ? "0" + this.date.getDay() : this.date.getDay()) + getDaySuffix(this.date.getDay()),
            month: ((this.date.getDate() < 10) ? "0" + this.date.getDate() : this.date.getDate()) + getDaySuffix(this.date.getDate())
        }
    }

    this.month = {
        index: (this.date.getMonth() + 1) < 10 ? "0" + (this.date.getMonth() + 1) : this.date.getMonth() + 1,
        name: this.months[this.date.getMonth()]
    };

    this.year = this.date.getFullYear();

    this.sym = {
        d: {
            d: this.date.getDate(),
            dd: (this.date.getDate() < 10) ? "0" + this.date.getDate() : this.date.getDate(),
            ddd: this.weekdays[this.date.getDay()].substring(0, 3),
            dddd: this.weekdays[this.date.getDay()],
            ddddd: ((this.date.getDate() < 10) ? "0" + this.date.getDate() : this.date.getDate()) + getDaySuffix(this.date.getDate()),
            m: this.date.getMonth() + 1,
            mm: (this.date.getMonth() + 1) < 10 ? "0" + (this.date.getMonth() + 1) : this.date.getMonth() + 1,
            mmm: this.months[this.date.getMonth()].substring(0, 3),
            mmmm: this.months[this.date.getMonth()],
            yy: (""+this.date.getFullYear()).substr(2, 2),
            yyyy: this.date.getFullYear()
        }
    };

    this.formats = {
        pretty: {
            a: this.sym.d.dddd,
            b: this.sym.d.ddddd,
            c: this.sym.d.mmmm,
            d: this.sym.d.yyyy
        }
    };
};



var dt = new DateTime();
$('.day').text(dt.formats.pretty.a);
$('.date').text(dt.formats.pretty.b);
$('.month').text(dt.formats.pretty.c);
$('.year').text(dt.formats.pretty.d);

$(function(){
    function horloge(){
        laDate = new Date();
        h = laDate.getHours();
        if(h < 10){
            h = '0' + h;
        }
        m = laDate.getMinutes();
        if(m < 10){
            m = '0' + m;
        }
        s = laDate.getSeconds();
        if(s < 10){
            s = '0' + s;
        }
        var time = h + ":" + m + ":" + s;
        $('#heure').text(time);
    };
    setInterval(horloge, 1000);
});