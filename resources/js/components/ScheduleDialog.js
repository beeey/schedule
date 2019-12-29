import React, { useState, useEffect } from 'react';
import moment from 'moment';
import Button from '@material-ui/core/Button';
import Dialog from '@material-ui/core/Dialog';
import DialogActions from '@material-ui/core/DialogActions';
import DialogContent from '@material-ui/core/DialogContent';
import DialogContentText from '@material-ui/core/DialogContentText';
import DialogTitle from '@material-ui/core/DialogTitle';
import TextField from '@material-ui/core/TextField';

const ScheduleDialog = ({ open, onOk, onCancel }) => {

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
                    <DialogContentText>
                        <TextField
                            id="date"
                            type="date"
                            defaultValue="2017-05-24"
                            InputLabelProps={{
                                shrink: true,
                            }}
                        />
                    </DialogContentText>
                </DialogContent>
                <DialogActions>
                    <Button onClick={onCancel} color="primary">
                        Disagree
                    </Button>
                    <Button onClick={onOk} color="primary" autoFocus>
                        Agree
                    </Button>
                </DialogActions>
            </Dialog>
        </div>
    );
}

export default ScheduleDialog;
