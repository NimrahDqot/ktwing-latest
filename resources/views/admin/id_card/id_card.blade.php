
    <table style="border: 1px solid #ddd; width: fit-content; margin: auto;">
        <tr>
            <td colspan="2" style="background-color: #02283D; color: white; text-align: center; padding: 1rem;">
                <h2 style="margin: 0;">Volunteer ID Card</h2>
            </td>
        </tr>
        <tr>
            <td colspan="2" align="center" style="padding: 1rem;">
                <img src="{{ asset($volunteer->image) }}" alt="Volunteer Photo"
                     style="border-radius: 50%; width: 100px; height: 100px; border: 3px solid #ddd;">
            </td>
        </tr>
        <tr>
            <td style="padding: 0.5rem; vertical-align: top;"><strong>Name:</strong></td>
            <td style="padding: 0.5rem;">{{ $volunteer->name }}</td>
        </tr>
        <tr>
            <td style="padding: 0.5rem; vertical-align: top;"><strong>Designation:</strong></td>
            <td style="padding: 0.5rem;">{{ $volunteer->designation }}</td>
        </tr>
        <tr>
            <td style="padding: 0.5rem; vertical-align: top;"><strong>ID Number:</strong></td>
            <td style="padding: 0.5rem;">{{ $volunteer->id }}</td>
        </tr>
        <tr>
            <td style="padding: 0.5rem; vertical-align: top;"><strong>Father's Name:</strong></td>
            <td style="padding: 0.5rem;">{{ $volunteer->father_name }}</td>
        </tr>
        <tr>
            <td style="padding: 0.5rem; vertical-align: top;"><strong>Phone:</strong></td>
            <td style="padding: 0.5rem;">{{ $volunteer->phone }}</td>
        </tr>
        <tr>
            <td style="padding: 0.5rem; vertical-align: top;"><strong>Email:</strong></td>
            <td style="padding: 0.5rem;">{{ $volunteer->email }}</td>
        </tr>
        <tr>
            <td style="padding: 0.5rem; vertical-align: top;"><strong>Address:</strong></td>
            <td style="padding: 0.5rem;">{{ $volunteer->address }}</td>
        </tr>
        <tr>
            <td colspan="2" style="background-color: #02283D; color: #FFFFFF; text-align: center; padding: 0.5rem;">
                <a href="https://ktwing.com/" target="_blank" style="color: #FFFFFF; text-decoration: none;">www.ktwing.com</a>
            </td>
        </tr>
    </table>

