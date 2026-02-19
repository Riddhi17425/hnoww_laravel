@extends('layouts.email')

@section('content')
<tr>
    <td class="email-body">
        <p>Hello Admin,</p>

        <p>
            A new Bespoke Commission Request has been received. The details are provided below:
        </p>

        <table width="100%" cellpadding="8" cellspacing="0" border="1" style="border-collapse: collapse; margin-top: 15px;">
            <tr>
                <td width="30%"><strong>Full Name</strong></td>
                <td>{{ $full_name }}</td>
            </tr>
            <tr>
                <td><strong>Email</strong></td>
                <td>{{ $email }}</td>
            </tr>
            <tr>
                <td><strong>Phone No.</strong></td>
                <td>{{ $phone ?? 'N/A' }}</td>
            </tr>
            <tr>
                <td><strong>Type of Commission</strong></td>
                <td>{{ $type_of_commission }}</td>
            </tr>
            <tr>
                <td><strong>Customer hoping to create</strong></td>
                <td>{{ $customer_hoping_to_create ?? 'N/A' }}</td>
            </tr>
            <tr>
                <td><strong>Intended Timeline</strong></td>
                <td>{{ $timeline ?? 'N/A' }}</td>
            </tr>
            <tr>
                <td><strong>Budget Comfort Range</strong></td>
                <td>{{ $budget ?? 'N/A' }}</td>
            </tr>
            <tr>
                <td><strong>Anything else we should know</strong></td>
                <td>{{ $additional_message ?? 'N/A' }}</td>
            </tr>
        </table>

        <p style="margin-top: 20px;">
            Thanks & Regards,<br>
            <strong>HNoWW</strong>
        </p>
    </td>
</tr>
@endsection
