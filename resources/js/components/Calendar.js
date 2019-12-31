import React, {useState, useEffect, useCallback} from 'react';
import moment from 'moment';
import { Calendar as BigCalendar, momentLocalizer } from 'react-big-calendar';
import ScheduleDialog from "./ScheduleDialog";

const localizer = momentLocalizer(moment);

const Calendar = () => {
    const [events, setEvents] = useState([]);
    const [open, setOpen] = useState(false);
    const onOk = useCallback(() => {
        setOpen(false)
    }, []);
    const onCancel = useCallback(() => {
        setOpen(false)
    }, []);

    useEffect(() => {
        (async () => {
            const response = await fetch('api/schedules', {
                method: 'get',
                headers: {
                    "Content-Type": "application/json; charset=utf-8",
                    "X-Requested-With": 'XMLHttpRequest',
                },
            });
            const { data } = await response.json();
            setEvents(data.map((event) => ({
                ...event,
                start: moment(event.starts_at).toDate(),
                end: moment(event.ends_at).toDate()
            })));
        })();
    }, []);

    return (
        <div>
            <BigCalendar
                localizer={localizer}
                events={events}
                startAccessor="start"
                endAccessor="end"
                style={{ height: 500 }}
                onDoubleClickEvent={(event) => {
                    setOpen(true)
                }}
            />
            <ScheduleDialog
                open={open}
                onOk={onOk}
                onCancel={onCancel}
            />
        </div>
    );
}

export default Calendar;
