import moment from "moment";


moment.locale('pt-br');

export const filterDateTime = (date) => {
    if (date) {
        return moment(date).format('DD/MM/YYYY HH:mm:ss');
    }
    return '';
}
