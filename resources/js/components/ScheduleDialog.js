import React, { useState, useEffect, useMemo } from 'react';
import moment from 'moment';
import Button from '@material-ui/core/Button';
import Dialog from '@material-ui/core/Dialog';
import DialogActions from '@material-ui/core/DialogActions';
import DialogContent from '@material-ui/core/DialogContent';
import DialogTitle from '@material-ui/core/DialogTitle';
import TextField from '@material-ui/core/TextField';
import styled from 'styled-components';
import { formatPHPDatetimeStringToDatetimeLocal } from "../utils/formatters";

const ScheduleDialog = ({ open, onOk, onCancel, schedule}) => {

    const [error, setError] = useState(false);
    const [startsAt, setStartsAt] = useState(formatPHPDatetimeStringToDatetimeLocal(schedule.starts_at));
    const [endsAt, setEndsAt] = useState(formatPHPDatetimeStringToDatetimeLocal(schedule.ends_at));

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
                            id="datetime-local"
                            label="開始"
                            type="datetime-local"
                            defaultValue={startsAt}
                            InputLabelProps={{
                                shrink: true,
                            }}
                        />
                    </DateTime>
                    <DateTime>
                        <TextField
                            id="datetime-local"
                            label="終了"
                            type="datetime-local"
                            defaultValue={endsAt}
                            InputLabelProps={{
                                shrink: true,
                            }}
                        />
                    </DateTime>
                    <form>
                        <ScheduleContent>
                            <TextField
                                required
                                id="outlined-required"
                                label="タイトル"
                                value={schedule.title}
                                variant="outlined"
                            />
                        </ScheduleContent>
                        <ScheduleContent>
                            <TextField
                                id="outlined-multiline-static"
                                label="内容"
                                multiline
                                rows="4"
                                value={schedule.content}
                                variant="outlined"
                            />
                        </ScheduleContent>
                    </form>
                </DialogContent>
                <DialogActions>
                    <Button onClick={onCancel} color="primary">
                        キャンセル
                    </Button>
                    <Button onClick={onOk} color="primary">
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
