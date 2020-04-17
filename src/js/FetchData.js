export async function fetchData(url, data) {
  const config = {
    method: "POST",
    body: data,
  };

  try {
    const urlFetch = await fetch(url, config);
    const response = await urlFetch.json();
    return { success: true, response: response };
  } catch (error) {
    return { success: false, error };
  }
}
