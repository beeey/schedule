import React, { useState, useEffect } from 'react';
import moment from 'moment';
import Button from '@material-ui/core/Button';
import Dialog from '@material-ui/core/Dialog';
import DialogActions from '@material-ui/core/DialogActions';
import DialogContent from '@material-ui/core/DialogContent';
import DialogTitle from '@material-ui/core/DialogTitle';
import TextField from '@material-ui/core/TextField';
import styled from 'styled-components';

const ScheduleDialog = ({ open, onOk, onCancel }) => {

    const [error, setError] = useState(false);

    useEffect(() => {
        (async () => {
            const response = await fetch('')
        })();
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
                            id="date"
                            label="日付"
                            type="date"
                            defaultValue="2017-05-24"
                            InputLabelProps={{
                                shrink: true,
                            }}
                        />
                    </DateTime>
                    <DateTime>
                        <TextField
                            id="time"
                            label="開始時間"
                            type="time"
                            defaultValue="07:30"
                            InputLabelProps={{
                                shrink: true,
                            }}
                        />
                    </DateTime>
                    <DateTime>
                        <TextField
                            id="time"
                            label="終了時間"
                            type="time"
                            defaultValue="07:30"
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
                                variant="outlined"
                            />
                        </ScheduleContent>
                        <ScheduleContent>
                            <TextField
                                id="outlined-multiline-static"
                                label="内容"
                                multiline
                                rows="4"
                                variant="outlined"
                            />
                        </ScheduleContent>
                    </form>
                </DialogContent>
                <DialogActions>
                    <Button onClick={onCancel} color="primary">
                        キャンセル
                    </Button>
                    <Button onClick={onOk} color="primary" autoFocus>
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
