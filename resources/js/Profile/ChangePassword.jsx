import axios from "axios";
import SmallSpinner from "../Component/SmallSpinner";
import React, { useState } from "react";

const ChangePassword=()=>{

    const [currentPassword,setCurrentPassword]=useState("");
    const [newPassword,setNewPassword]=useState("");
    const [confirmPassword,setConfirmPassword]=useState("");
    const [loader,setLoader]=useState(false);

    const changePassword=()=>{
        axios.post("/api/change-password?user_id="+window.auth.id,{currentPassword,newPassword}).then((d)=>{
            const {data}=d;
            if(data.message===false){
                showToast('Wrong Password');
            }
        });
    };

    return (<div className="container mt-3">
        <div className="card p-5">
            <div className="form-group">
                <label htmlFor="">Enter Current Password</label>
                <input type="password" className="form-control"
                onChange={(e)=>setCurrentPassword(e.target.value)}
                />
            </div>
            <div className="form-group">
                <label htmlFor="">Enter New Password</label>
                <input type="password" className="form-control"
                onChange={(e)=>setNewPassword(e.target.value)}
                />
            </div>
            <div className="form-group">
                <label htmlFor="">Confirm New Password</label>
                <input type="password" className="form-control"
                onChange={(e)=>setConfirmPassword(e.target.value)}
                 />
            </div>
            <div>
                <button className="btn btn-dark"
                onClick={()=>changePassword()}
                >
                    {loader && <SmallSpinner/>}

                    Change</button>
            </div>
        </div>
    </div>
    );
};

export default ChangePassword;
