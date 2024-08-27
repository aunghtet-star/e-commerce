import Spinner from "../Component/Spinner";
import axios from "axios";
import React, { useEffect, useState } from "react";

const Order=()=>{
    const [loader,setLoader]=useState(true);
    const [order,setOrder]=useState({});

    useEffect(()=>{
        const user_id=window.auth.id;
        axios.get(`/api/order?user_id=${user_id}`).then(({data})=>{
            setOrder(data.data);
            setLoader(false);
        });
    },[]);
    return (
    <div>
        {loader && <Spinner/>}
        {!loader && (
            <>
            <table className="table table-strike">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                {order.data.map((d)=>(
                    <tr key={d.id}>
                        <td>
                            <img src={d.product.image_url} style={{width:50}} alt={d.product.name} />
                        </td>
                        <td>{d.product.name}</td>
                        <td>{d.total_quantity}</td>
                        <td>{d.product.discount_price}</td>
                        <td>
                            {d.status==="cancel" && (
                                <span className="badge badge-danger">Cancel</span>
                            )}

                        </td>
                        <td>
                            {d.status==="success" && (
                                <span className="badge badge-success">Success</span>
                            )}

                        </td>
                        <td>
                            {d.status==="pending" && (
                                <span className="badge badge-warning">pending</span>
                            )}

                        </td>
                    </tr>
                ))}
            </tbody>
        </table>
            </>
        )}

    </div>
    );
};
export default Order;
