import React, {useState, useEffect, useCallback, useMemo } from 'react';
import moment from 'moment';
import { Calendar as BigCalendar, momentLocalizer } from 'react-big-calendar';
import ScheduleDialog from "./ScheduleDialog";
import { formatSchedulesForCalendar } from "../utils/formatters";

const localizer = momentLocalizer(moment);

const Calendar = () => {
    const [schedules, setSchedules] = useState([]);
    const [openedSchedule, setOpenedSchedule] = useState(null);
    const [open, setOpen] = useState(false);
    const onOk = useCallback(() => {
        setOpen(false);
        setOpenedSchedule(null);
    }, []);
    const onCancel = useCallback(() => {
        setOpen(false);
        setOpenedSchedule(null);
    }, []);
    const formattedSchedules = useMemo(() => formatSchedulesForCalendar(schedules), [schedules]);

    useEffect(() => {
        (async () => {
            const response = await fetch('api/schedules', {
                method: 'get',
                mode: 'cors',
                headers: {
                    "Content-Type": "application/json; charset=utf-8",
                    "X-Requested-With": 'XMLHttpRequest',
                },
                credentials: 'include'
            });

            if (response.status >= 400) {
                alert(await response.text());
                return;
            }

            const { data } = await response.json();
            setSchedules(data);
        })();
    }, []);

    return (
        <div>
            <BigCalendar
                localizer={localizer}
                events={formattedSchedules}
                startAccessor="start"
                endAccessor="end"
                style={{ height: 500 }}
                onDoubleClickEvent={(formattedSchedule) => {
                    setOpen(true);
                    setOpenedSchedule(formattedSchedule.resource);
                }}
            />
            {openedSchedule && <ScheduleDialog
                open={open}
                onOk={onOk}
                onCancel={onCancel}
                schedule={openedSchedule}
                onUpdateComplete={(updatedSchedule) => {
                    setSchedules(schedules.map((schedule) => {
                        return schedule.id === updatedSchedule.id ? updatedSchedule : schedule;
                    }));
                }}
            />}
        </div>
    );
}

export default Calendar;
