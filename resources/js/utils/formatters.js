import moment from 'moment';

export const formatScheduleForCalendar = (apiSchedule) => {
    return {
        title: apiSchedule.title,
        start: moment(apiSchedule.starts_at).toDate(),
        end: moment(apiSchedule.ends_at).toDate(),
        allDay: false,
        resource: apiSchedule,
    };
};

export const formatSchedulesForCalendar = (apiSchedules) => {
    return apiSchedules.map(formatScheduleForCalendar);
};

export const formatPHPDatetimeStringToDatetimeLocal = (phpDatetimeString) => {
    return moment(phpDatetimeString).format('YYYY-MM-DDTHH:MM');
};

export const formatDatetimeLocalToPHPDatetimeString = (datetimeLocal) => {
    return moment(datetimeLocal).format('YYYY-MM-DD HH:MM:SS');
};
