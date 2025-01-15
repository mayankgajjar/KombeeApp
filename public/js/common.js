function logout() {
    fetch(siteUrl + `api/admin/logout`, {
        method: "POST",
        headers: {
            "Authorization": "Bearer " + token, // Replace with the user's access token
            "Accept": "application/json",
        },
    })
        .then(response => response.json())
        .then(res => {
            if (res.success) {
                location.href = res.redirectUrl;
            } else {
                console.error("Failed to log out:", res.message);
            }
        })
        .catch(error => {
            console.error("Error during logout:", error);
        });
}
