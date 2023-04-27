$(document).ready(function () {
	const chunkSize = 5 * 1024 * 1024; // 5 MB

	$("#myForm").on("submit", async function (event) {
		event.preventDefault();
		const model = $("#model").val();
		const stems = $("#stems").val();
		const emailAddress = $("#emailAddress").val();

		const file = $("#file")[0].files[0];
		const uuid = generateUUID(); // Generate a unique UUID for each upload session

		if (!file) {
			console.error("No file selected");
			return;
		}

		// Hide the form and reset the completion message
		$("#myForm").hide();
		$("#completion-message").hide();
		$("#progress").show();


		const totalChunks = Math.ceil(file.size / chunkSize);
		for (let chunkIndex = 0; chunkIndex < totalChunks; chunkIndex++) {
			const start = chunkIndex * chunkSize;
			const end = start + chunkSize;
			const chunk = file.slice(start, end);

			const formData = new FormData();
			formData.append("model", model);
			formData.append("stems", stems);
			formData.append("emailAddress", emailAddress);

			formData.append("file", chunk);
			formData.append("chunkIndex", chunkIndex);
			formData.append("totalChunks", totalChunks);
			formData.append("fileName", file.name);
			formData.append("uuid", uuid); // Append the UUID to the formData

			try {
				const response = await fetch("upload_chunk.php", {
					method: "POST",
					body: formData
				});

				const result = await response.text();
				console.log(result);

				const progressPercentage = ((chunkIndex + 1) / totalChunks) * 100;
				$("#progress-bar").width(progressPercentage + "%");

			} catch (error) {
				console.error("Error uploading chunk:", error);
			}
		}
		$("#completion-message").show();

	});
});

function generateUUID() {
	return ([1e7] + -1e3 + -4e3 + -8e3 + -1e11).replace(/[018]/g, (c) =>
		(c ^ (crypto.getRandomValues(new Uint8Array(1))[0] & (15 >> (c / 4)))).toString(16)
	);
}