import React, {useState, useEffect, useMemo, useCallback} from 'react';
import moment from 'moment';
import Button from '@material-ui/core/Button';
import Dialog from '@material-ui/core/Dialog';
import DialogActions from '@material-ui/core/DialogActions';
import DialogContent from '@material-ui/core/DialogContent';
import DialogTitle from '@material-ui/core/DialogTitle';
import TextField from '@material-ui/core/TextField';
import styled from 'styled-components';
import { formatPHPDatetimeStringToDatetimeLocal, formatDatetimeLocalToPHPDatetimeString } from "../utils/formatters";

const ScheduleDialog = ({ open, onOk: parentOnOk, onCancel, schedule, onUpdateComplete }) => {

    const [title, setTitle] = useState(schedule.title);
    const [content, setContent] = useState(schedule.content);
    const [startsAt, setStartsAt] = useState(formatPHPDatetimeStringToDatetimeLocal(schedule.starts_at));
    const [endsAt, setEndsAt] = useState(formatPHPDatetimeStringToDatetimeLocal(schedule.ends_at));

    const titleErrorText = useMemo(() => {
        if (!title) {
            return 'タイトルは必須です';
        }
        if (title.length > 30) {
            return 'タイトルは30文字以内で入力してください。';
        }
        return '';
    }, [title]);
    const dateTimeErrorText = useMemo(() => {
        console.log(startsAt, endsAt);
        if (startsAt > endsAt) {
            return '終了時間が開始時間よりも前になっています。';
        }
        return '';
    }, [startsAt, endsAt]);

    const onOk = useCallback(() => {
        const postSchedule = {
            title: title,
            content: content,
            starts_at: startsAt,
            ends_at: endsAt
        };
        (async () => {
            const response = await fetch(`api/schedules/${schedule.id}`, {
                method: 'PUT',
                headers: {
                    "Content-Type": "application/json; charset=utf-8",
                    "X-Requested-With": 'XMLHttpRequest',
                },
                body: JSON.stringify(postSchedule)
            });
            const { data } = await response.json();
            if (onUpdateComplete) {
                onUpdateComplete(data);
            }
        })();
        parentOnOk();
    }, [parentOnOk, title, content, startsAt, endsAt]);

    useEffect(() => {
    }, []);

    return (
        <div>
            <Dialog
                open={open}
                onClose={onCancel}
            >
                <DialogTitle>予定を編集</DialogTitle>
                <DialogContent>
                    <DateTime>
                        <TextField
                            error={!!dateTimeErrorText}
                            required={true}
                            id="datetime-local"
                            label="開始"
                            type="datetime-local"
                            defaultValue={startsAt}
                            helperText={dateTimeErrorText}
                            InputLabelProps={{
                                shrink: true,
                            }}
                            onChange={(event) => {
                                setStartsAt(formatDatetimeLocalToPHPDatetimeString(event.target.value));
                            }}
                        />
                    </DateTime>
                    <DateTime>
                        <TextField
                            error={!!dateTimeErrorText}
                            required={true}
                            id="datetime-local"
                            label="終了"
                            type="datetime-local"
                            helperText={dateTimeErrorText}
                            defaultValue={endsAt}
                            InputLabelProps={{
                                shrink: true,
                            }}
                            onChange={(event) => {
                                setEndsAt(formatDatetimeLocalToPHPDatetimeString(event.target.value));
                            }}
                        />
                    </DateTime>
                    <form>
                        <ScheduleContent>
                            <TextField
                                error={!!titleErrorText}
                                required={true}
                                id="outlined-required"
                                label="タイトル"
                                defaultValue={schedule.title}
                                variant="outlined"
                                helperText={titleErrorText}
                                onChange={(event) => {
                                    setTitle(event.target.value);
                                }}
                            />
                        </ScheduleContent>
                        <ScheduleContent>
                            <TextField
                                id="outlined-multiline-static"
                                label="内容"
                                multiline
                                rows="4"
                                defaultValue={schedule.content}
                                variant="outlined"
                                onChange={(event) => {
                                    setContent(event.target.value);
                                }}
                            />
                        </ScheduleContent>
                    </form>
                </DialogContent>
                <DialogActions>
                    <Button onClick={onCancel} color="primary">
                        キャンセル
                    </Button>
                    <Button
                        onClick={onOk}
                        color="primary"
                        disabled={!!titleErrorText || !!dateTimeErrorText}
                    >
                        保存
                    </Button>
                </DialogActions>
            </Dialog>
        </div>
    );
};

export default ScheduleDialog;

const DateTime = styled.div`
    display: inline-block;
    padding: 5px;
`;

const ScheduleContent = styled.div`
    display: block;
    padding: 5px;
`;
